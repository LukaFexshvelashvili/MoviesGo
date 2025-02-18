<script>
const iframes = document.querySelectorAll("iframe");
if (iframes) {

    iframes.forEach((iframe) => {
        iframe.onload = () => {
            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

            const adIframes = iframeDoc.querySelectorAll("iframe[src*='ads']");
            adIframes.forEach(adIframe => adIframe.remove());

            const adImages = iframeDoc.querySelectorAll("img[src*='ads']");
            adImages.forEach(adImage => adImage.remove());

            const adScripts = iframeDoc.querySelectorAll("script[src*='ads']");
            adScripts.forEach(adScript => adScript.remove());
        };
    });
}
</script>