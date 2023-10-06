<?php
global $post;
    $post_author = $post->post_author;
    $firstName = get_the_author_meta('user_firstname', $post_author);
    $lastName = get_the_author_meta('user_lastname', $post_author);
    $author = get_userdata($post_author);
    $authorRoles = $author->roles;
    $linkedin_link = esc_attr( get_option( 'linkedin_link' ) );
    $hackerrank_link = esc_attr( get_option( 'hackerrank_link' ) );
    $github_link = esc_attr( get_option( 'github_link' ) );
?>

<div class="author-card card">

    <div class="left">
        
        <div class="author-pic">

            <a href="<?php echo get_author_posts_url($post->post_author); ?>">
                <?php echo get_avatar( $post->post_author, 500 ) ?>
            </a>
        </div>

        <div class="author-name">

            <h3><?php 
                $firstName = get_the_author_meta('user_firstname', $post->post_author);
                $lastName = get_the_author_meta('user_lastname', $post->post_author);

                echo "$firstName $lastName" 
            ?></h3>
        </div>

        <div class="author-role">

            <h4><?php 
                $author = get_userdata($post->post_author);
                $authorRoles = $author->roles;

                foreach($authorRoles as $roles) {
                    echo ucfirst($roles);
                }
            ?></h4>
        </div>
    </div>

    <div class="right">

        <div class="author-bio">

            <p><?php 
                the_author_meta('description', $post->post_author); 
            ?></p>
        </div>

        <div class="author-contact">
            
            <button onclick="window.open('mailto:<?php echo get_the_author_meta('email', $post->post_author); ?>')">
                <h3>Hire
                    <?php the_author_meta('user_firstname', $post->post_author); ?>
                </h3>
            </button>
        </div>
    </div>
</div>
