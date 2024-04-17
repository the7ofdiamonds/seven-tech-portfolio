function ProjectTags(props) {
  const { project_tags } = props;

  const handleClick = (slug) => {
    window.location.href = slug;
  };

  return (
    Array.isArray(project_tags) && (
      <div className="project-tags">
        <h4 className="title">Project Tags</h4>

        <div className="tags-row">
          {project_tags.map((project_tag, index) => (
            <button
              key={index}
              className="tag"
              onClick={() => handleClick(project_tag.url)}>
              <h3>#{project_tag.name}</h3>
            </button>
          ))}
        </div>
      </div>
    )
  );
}

export default ProjectTags;
