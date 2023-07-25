<?php
$tags = get_the_tags($post->ID);
if ($tags) :
?>
    <div class="project-tags">
        <?php
        foreach ($tags as $tag) : ?>
            <button class="tag">
                <h3><?php echo $tag->name; ?></h3>
            </button>
        <?php endforeach; ?>
    </div>
<?php endif; ?>