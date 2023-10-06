<details>
    <summary>
        <h3 class='post-name project-name'><?php echo get_the_title($post->ID); ?></h3>
    </summary>

    <div class="project-details">

        <div class="post-description-short project-description-short">
            <?php echo get_the_excerpt($post->ID); ?>
        </div>

        <?php include WP_PLUGIN_DIR . '/thfw-portfolio/includes/part-project-type.php'; ?>

        <?php include WP_PLUGIN_DIR . '/thfw-portfolio/includes/part-project-tag.php'; ?>
    </div>
</details>