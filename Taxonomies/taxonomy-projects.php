<?php get_header(); ?>

    <section class="taxonomy">

        <?php

        $args = array(
            'post_type' => array('post', 'portfolio'),
            'posts_per_page' => 10,
            'tax_query' => array(
                array (
                    'taxonomy' => 'projects',
                    'field' => 'slug',
                    'terms' => array( get_queried_object()->slug ),
                )
            )
        );
        
        $portfolio = new WP_Query($args);

        if ( $portfolio ) :

            foreach($portfolio as $project) :
        ?>
        
        <?php include WP_PLUGIN_DIR . '/thfw-portfolio/post-types/includes/part-project-card.php';?>
        <?php endforeach; endif;?>
    </section>
<?php get_footer(); ?>