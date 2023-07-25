<?php
$default_image_url = get_template_directory_uri() . '/assets/default-image.png';
$post_thumbnail = get_the_post_thumbnail($post->ID);
?>

<article class="post project">

  <div class="post-card project-card card">

    <div class="post-featured-image project-featured-image">
      <a href="<?php the_permalink($post->ID); ?>">
        <?php
        if (has_post_thumbnail($post->ID)) {
          echo $post_thumbnail;
        } else {
        ?>
          <img src="<?php echo $default_image_url ?>" alt="">
        <?php
        }
        ?>
      </a>
    </div>

    <?php include WP_PLUGIN_DIR . '/thfw-portfolio/includes/part-project-details.php'; ?> 
  </div>
</article>