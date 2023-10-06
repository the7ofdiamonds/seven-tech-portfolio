<?php get_header(); ?>

    <section class="taxonomy">

        <?php

        $args = array(
            'post_type' => array('post', 'portfolio'),
            'posts_per_page' => 10,
            'tax_query' => array(
                array (
                    'taxonomy' => 'project_tags',
                    'field' => 'slug',
                    'terms' => array( get_queried_object()->slug ),
                )
            )
        );
       
        $portfolio = new WP_Query($args);
        error_log(print_r($portfolio->posts, true));
        if ( $portfolio->posts ) :

            foreach($portfolio->posts as $project) :
                error_log(print_r($project, true));
        ?>
        
        <?php endforeach; endif;?>

        <h1>Tags</h1>
    </section>
<?php get_footer(); ?>