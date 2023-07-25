<?php 
    global $post;
    
    if (!function_exists('is_plugin_active')) {
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');
	}
?>

<?php get_header(); ?>
    <section id="project" class="project">

        <?php include THFW_PORTFOLIO . 'includes/part-project-gallery.php'; ?>
        
        <h2 class="title"><?php the_title(); ?></h2>

        <div class="project-info">

            <?php include THFW_PORTFOLIO . 'includes/part-project-type.php'; ?>
            
            <?php include THFW_PORTFOLIO . 'includes/part-project-status.php'; ?>

        </div>

        <?php the_content(); ?>

        <?php do_shortcode('[awards]'); ?>

        <?php
            if (is_plugin_active('orb-services/ORB-Services.php')) { 
                do_shortcode('[testimonials]');
            }
        ?>
        
        <?php include THFW_PORTFOLIO . 'includes/part-project-author.php'; ?>

        <?php include THFW_PORTFOLIO . 'includes/part-project-tag.php'; ?>

        <div class="project-action-button">
            <button class="project-button">
                <h3>
                    <?php echo get_post_meta($project->ID, '_project_button', true); ?>
                </h3>
            </button>
        </div>
    </section>
<?php get_footer(); ?>