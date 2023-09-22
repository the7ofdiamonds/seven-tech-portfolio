<section class="thfw_portfolio" id="thfw_portfolio">

    <h2 class="title">PORTFOLIO</h2>

    <?php
    $args = array('post_type' => 'portfolio');

    $posts = get_posts($args);

    if ($posts) {

        foreach ($posts as $post) {

            include WP_PLUGIN_DIR . '/thfw-portfolio/includes/part-project.php';
        }
    } else {
        echo 'There are no projects in this portfolio yet.';
    }
    ?>

</section>