<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        $currentURL = $_SERVER['REQUEST_URI'];
        $urlPosition = explode('/', $currentURL);
        $page = get_page_by_path($urlPosition[2], OBJECT, 'founders');

        if ($page) {
            $founderTitle = $page->post_title;
            $resumeTitle = $founderTitle . ' Resume';
            echo $resumeTitle;
        } else {
            echo "Resume could not be found!";
            die;
        }
        ?>
    </title>

    <?php
    $site_icon_url = get_site_icon_url();

    $upload_dir = wp_upload_dir();
    $pdf_subdir = '/resume';
    $upload_path = $upload_dir['basedir'] . $pdf_subdir;
    $upload_url = $upload_dir['baseurl'] . $pdf_subdir;
    $resume_pdf = $upload_path . '/Resume_' . $page->ID . '.pdf';
    $resume_pdf_url = $upload_url . '/Resume_' . $page->ID . '.pdf';

    if ($site_icon_url) {
        echo '<link rel="icon" href="' . esc_url($site_icon_url) . '" sizes="32x32" type="image/png">';
    }
    ?>
    <style>
        main {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <style>
        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <?php
    if (file_exists($resume_pdf)) : ?>
        <iframe id="pdfViewer" src="<?php echo $resume_pdf_url; ?>" frameborder="0"></iframe>
    <?php else : ?>
        <main>
            <h4>This resume does not exist.</h4>
        </main>
    <?php endif; ?>

</body>

</html>