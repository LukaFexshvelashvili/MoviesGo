<div class="movie_comments">
    <h3>კომენტარები:</h3>
    <?php
if(is_logged()){
            ?>
    <div class="c_profile">
        <div class="cnt c_profile_block">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21M8 7C8 8.06087 8.42143 9.07828 9.17157 9.82843C9.92172 10.5786 10.9391 11 12 11C13.0609 11 14.0783 10.5786 14.8284 9.82843C15.5786 9.07828 16 8.06087 16 7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7Z"
                    stroke="white" stroke-opacity="0.9" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>
        <div class="c_profile_name"><?php echo $_SESSION['nickname'] ?></div>
        <?php echo $_SESSION['status'] == $admin_status ? '<div class="cnt c_profile_badge dev_badge">დეველოპერი</div>' : "" ?>
    </div>
    <form class="c_form" id="comment_form">
        <div class="replying" style="display: none;">
            <p>პასუხობ: <span id="to_answer"></span> | <span id="to_comment"></span></p>
            <div class="reply_close cnt">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.8905 10.315L16.3003 5.90514C16.5096 5.69622 16.6274 5.41271 16.6276 5.11699C16.6279 4.82127 16.5107 4.53755 16.3017 4.32826C16.0928 4.11897 15.8093 4.00125 15.5136 4.00098C15.2179 4.00072 14.9342 4.11795 14.7249 4.32687L10.315 8.73673L5.90514 4.32687C5.69585 4.11758 5.41199 4 5.116 4C4.82002 4 4.53616 4.11758 4.32687 4.32687C4.11758 4.53616 4 4.82002 4 5.116C4 5.41199 4.11758 5.69585 4.32687 5.90514L8.73673 10.315L4.32687 14.7249C4.11758 14.9342 4 15.218 4 15.514C4 15.81 4.11758 16.0938 4.32687 16.3031C4.53616 16.5124 4.82002 16.63 5.116 16.63C5.41199 16.63 5.69585 16.5124 5.90514 16.3031L10.315 11.8933L14.7249 16.3031C14.9342 16.5124 15.218 16.63 15.514 16.63C15.81 16.63 16.0938 16.5124 16.3031 16.3031C16.5124 16.0938 16.63 15.81 16.63 15.514C16.63 15.218 16.5124 14.9342 16.3031 14.7249L11.8905 10.315Z" />
                </svg>
            </div>
        </div>
        <input name="reply_id" type="hidden" id="reply_id"></input>
        <input name="movie_id" type="hidden" id="movie_id" value="<?php echo $movie['id'] ?>"></input>
        <textarea placeholder="შეტყობინება..." class="c_textarea" id="comment_input" name="comment_input"></textarea>
        <button class="dbtw c_button">დაკომენტარება</button>
    </form>
    <?php
} else {
            ?>
    <div class="login_error">
        <p>კომენტარის დასაწერად გთხოვთ გაიაროთ <a href="./login">ავტორიზაცია</a></p>

    </div>
    <?php
}
            ?>

    <div class="line"></div>
    <div class="comments_row">


    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
const c_server_start_local = '<?php echo $server_start_local ?>';

function initializeComments() {
    $.ajax({
        url: c_server_start_local + "movie/get_comments.php",
        type: "GET",
        data: {
            movie_id: <?php echo $movie['id']; ?>
        },
        success: function(data) {

            $(".comments_row").html(data);
        }
    })
}
initializeComments()
$(document).on("click", ".reply_to_comment", function() {
    let reply_id = $(this).data("reply-id");
    let reply_name = $(this).data("reply-name");
    let reply_comment = $(this).data("reply-comment");
    $(".replying").css("display", "flex");
    $("#to_answer").text(reply_name);
    $("#to_comment").text(reply_comment);
    $("#reply_id").val(reply_id);
    $("#comment_input").val(`@${reply_name} `);


    $('html, body').animate({
        scrollTop: $(".replying").offset().top - 200
    }, 300);

})
$(document).on("click", ".delete_comment", function() {
    $.ajax({
        url: c_server_start_local + "actions/delete_comment.php",
        type: "POST",
        data: {
            comment_id: $(this).data("comment-id")
        },
        success: function(response) {
            let data = JSON.parse(response);
            if (data.status == 100) {
                initializeComments()
            } else {
                alert("შეცდომა");
            }
        }
    })
})


$(".reply_close").click(() => {
    clear_comment_inputs()
})

function clear_comment_inputs() {
    $(".replying").css("display", "none");
    $("#comment_input").val("");
    $("#reply_id").val("");
    $("#to_answer").text("");
    $("#to_comment").text("");
}

$("#comment_form").submit((e) => {
    e.preventDefault();
    let form_data = $("#comment_form").serialize();

    $.ajax({
        url: c_server_start_local + "actions/comment.php",
        type: "POST",
        data: form_data,
        success: function(response) {
            let data = JSON.parse(response);
            if (data.status == 100) {
                initializeComments()
                clear_comment_inputs()
            } else {
                alert("შეცდომა");
            }
        }
    })
})
</script>