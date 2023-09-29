function ProjectAuthor(props) {
  console.log(props);

  return (
    <>
      <div class="author-card card">
        <div class="left">
          <div class="author-pic">
            <a href={author_url}>
              <img src={avatar_url} alt="" />
            </a>
          </div>

          <div class="author-name">
            <h3>
              {first_name} {last_name}
            </h3>
          </div>

          <div class="author-role">
            <h4>{roles}</h4>
          </div>
        </div>

        <div class="right">
          <div class="author-bio">
            <p>{description}</p>
          </div>

          <div class="author-contact">
            <button onClick="window.open('mailto:<?php echo get_the_author_meta('email', $post->post_author); ?>')">
              <h3>Hire {firstname}</h3>
            </button>
          </div>
        </div>
      </div>
    </>
  );
}

export default ProjectAuthor;
