<?php get_header(); ?>

    <section class="taxonomy">

        <?php

        $args = array(
            'post_type' => array('post', 'portfolio'),
            'posts_per_page' => 10,
            'tax_query' => array(
                array (
                    'taxonomy' => 'project_types',
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

        <h1>Types</h1>
    </section>
<?php get_footer(); ?>