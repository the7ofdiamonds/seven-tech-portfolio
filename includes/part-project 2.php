<article class="post project">

  <div class="post-card project-card card">

    <div class="post-featured-image project-featured-image">
      <a href="<?php the_permalink($project->ID); ?>">
        <?php echo get_the_post_thumbnail($project->ID); ?>
      </a>
    </div>

    <?php include WP_PLUGIN_DIR . '/thfw-portfolio/includes/part-project-details.php'; ?> 
  </div>
</article>