<?php
include_once "../connection.php";
if (isset($_GET['movie_id']) && is_numeric($_GET['movie_id'])) {

$movie_id = intval($_GET['movie_id']); // Sanitize input

$query = "
 WITH latest_comments AS (
    SELECT 
        c.id AS comment_id, 
        c.movie_id, 
        c.user_id, 
        c.reply_id, 
        c.comment, 
        c.create_date,
        u.id AS author_id, 
        u.nickname, 
        u.status, 
        u.role
    FROM comments c
    JOIN users u ON c.user_id = u.id
    WHERE c.movie_id = ? AND c.reply_id IS NULL
    ORDER BY c.create_date DESC
    LIMIT 10
)
SELECT 
    c.id AS comment_id, 
    c.movie_id, 
    c.user_id, 
    c.reply_id, 
    c.comment, 
    c.create_date,
    u.id AS author_id, 
    u.nickname, 
    u.status, 
    u.role
FROM comments c
JOIN users u ON c.user_id = u.id
WHERE c.movie_id = ? AND (c.reply_id IN (SELECT comment_id FROM latest_comments) OR c.id IN (SELECT comment_id FROM latest_comments))
ORDER BY c.create_date DESC;

";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $movie_id, $movie_id);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];
$topLevelComments = [];

while ($row = $result->fetch_assoc()) {
    if ($row['reply_id'] == null) {
        $topLevelComments[$row['comment_id']] = $row;
        $topLevelComments[$row['comment_id']]['replies'] = [];
    }
}

$result->data_seek(0);
while ($row = $result->fetch_assoc()) {
    if ($row['reply_id'] !== null) {
        $parentId = $row['reply_id'];
        if (isset($topLevelComments[$parentId])) {
            // Attach reply to its parent comment
            $topLevelComments[$parentId]['replies'][] = $row;
        }
    }
}

$comments = array_values($topLevelComments);
if(count($comments) == 0){
    echo "<div class='info_result_desc'>კომენტარები არ არის</div>";
} else {
foreach ($topLevelComments as $comment) {
?>
<div class="comment">
    <div class="comment_start">
        <div class="c_first">
            <a href="./profile?id=<?php echo $comment['author_id']; ?>" class="c_profile">
                <div class="cnt c_profile_block">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21M8 7C8 8.06087 8.42143 9.07828 9.17157 9.82843C9.92172 10.5786 10.9391 11 12 11C13.0609 11 14.0783 10.5786 14.8284 9.82843C15.5786 9.07828 16 8.06087 16 7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7Z"
                            stroke="white" stroke-opacity="0.9" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="c_profile_name"><?php echo $comment['nickname']; ?></div>
                <?php
                        if($comment['status'] == $admin_status){
                            
                        ?>
                <div class="cnt c_profile_badge dev_badge">დეველოპერი</div>

                <?php
                            }
                        ?>
            </a>
        </div>
        <div class="c_last">
            <?php echo get_local_time($comment['create_date']); ?>
        </div>
    </div>
    <div class="comment_content"><?php echo substr($comment['comment'], 0, 200) ?></div>
    <div class="comment_actions">
        <?php
if(is_logged() && $comment['author_id'] == $_SESSION['user_id']){
        ?>
        <button data-comment-id="<?php echo $comment['comment_id']; ?>" class="dbt delete_comment">წაშლა</button>
        <?php

                        }
?>
        <button data-reply-id="<?php echo $comment['comment_id']; ?>"
            data-reply-name="<?php echo $comment['nickname']; ?>"
            data-reply-comment="<?php echo substr($comment['comment'], 0, 20)."..."; ?>"
            class="dbts reply_to_comment">პასუხი</button>
    </div>
</div>

<?php
        if (!empty($comment['replies'])) {
            foreach ($comment['replies'] as $replied) {
            ?>
<div class="comment reply">
    <div class="comment_start">
        <div class="c_first">
            <a href="./profile?id=<?php echo $replied['author_id']; ?>" class="c_profile">
                <div class="cnt c_profile_block">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21M8 7C8 8.06087 8.42143 9.07828 9.17157 9.82843C9.92172 10.5786 10.9391 11 12 11C13.0609 11 14.0783 10.5786 14.8284 9.82843C15.5786 9.07828 16 8.06087 16 7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7Z"
                            stroke="white" stroke-opacity="0.9" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="c_profile_name"><?php echo $replied['nickname']; ?></div>
                <?php
                        if($replied['status'] == $admin_status){
                            
                        ?>
                <div class="cnt c_profile_badge dev_badge">დეველოპერი</div>

                <?php
                            }
                        ?>
            </a>
        </div>
        <div class="c_last">
            <?php echo get_local_time($replied['create_date']); ?>
        </div>
    </div>
    <div class="comment_content"><?php echo substr($replied['comment'], 0, 200) ?></div>
    <div class="comment_actions">
        <?php
if(is_logged() && $replied['author_id'] == $_SESSION['user_id']){
        ?>
        <button data-comment-id="<?php echo $comment['comment_id']; ?>" class="dbt delete_comment">წაშლა</button>
        <?php

                        }
?>
        <button data-reply-id="<?php echo $comment['comment_id']; ?>"
            data-reply-name="<?php echo $replied['nickname']; ?>"
            data-reply-comment="<?php echo substr($replied['comment'], 0, 20)."..."; ?>"
            class="dbts reply_to_comment">პასუხი</button>
    </div>
</div>

<?php

        }
    }
}
}
}

$stmt->close();
?>