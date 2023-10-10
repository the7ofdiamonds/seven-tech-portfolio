<div class="author-intro">
    <div class="author">
        <h2 class='title'>Founder</h2>
        <div class="author-card card">
            <div class="author-pic">
                <img src="<?php echo get_avatar_url($post->post_author, ['size' => 384]); ?>" alt="">
            </div>
        </div>
        <h4 class="title">Jamel C. Lyons</h4>
    </div>

    <div class="author-card card">
        <p class="author-greeting">
            <?php echo get_the_author_meta('description', 1); ?>
        </p>
    </div>
</div>