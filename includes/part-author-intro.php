<?php $firstName = get_the_author_meta('user_firstname', $post->post_author);
$lastName = get_the_author_meta('user_lastname', $post->post_author);
?>
<div class="author-intro">
    <div class="author-card card">
        <div class="author-pic">
            <img src="<?php echo get_avatar_url($post->post_author, ['size' => 384]); ?>" alt="">
        </div>
    </div>

    <div class="author-card card">
        <p class="author-greeting">My name is Jamel C. Lyons a designer programmer I am on a mission to make the world a better by digitizing processes.</p>
    </div>
</div>