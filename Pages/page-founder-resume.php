<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamel C. Lyons Resume</title>
    <style>
        /* Style the iframe to take up the entire screen */
        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <button id="toggleFullscreen">Toggle Fullscreen</button>

    <script>
        const iframe = document.getElementById('pdfViewer');
        const toggleFullscreenButton = document.getElementById('toggleFullscreen');

        toggleFullscreenButton.addEventListener('click', () => {
            // Check if the browser supports full-screen mode
            if (iframe.requestFullscreen) {
                // Toggle full-screen mode
                if (document.fullscreenElement) {
                    document.exitFullscreen();
                } else {
                    iframe.requestFullscreen();
                }
            } else {
                alert('Your browser does not support full-screen mode.');
            }
        });
    </script>

    <?php
    $resume_pdf = THFW_PORTFOLIO . 'resume/Jamel_C_Lyons_Resume.pdf';
    $resume_pdf_url = THFW_PORTFOLIO_URL . 'resume/Jamel_C_Lyons_Resume.pdf';

    if (file_exists($resume_pdf)) : ?>
        <iframe id="pdfViewer" src="<?php echo $resume_pdf_url; ?>" frameborder="0"></iframe>
    <?php else : ?>
        <h4>This resume does not exist.</h4>
    <?php endif; ?>

</body>

</html>