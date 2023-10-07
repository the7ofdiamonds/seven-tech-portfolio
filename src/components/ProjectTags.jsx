function ProjectTags(props) {
  const { project_tags } = props;

  const handleClick = (slug) => {
    window.open(`${slug}`);
  };
  
  return (
    <>
      <div className="project-tags">
        <h4 className="title">Project Tags</h4>

        <div className="tag-row">
          {Array.isArray(project_tags) &&
            project_tags.map((project_tag, index) => (
              <button
                className="tag"
                onClick={() => handleClick(project_tag.slug)}>
                <h3 key={index}>#{project_tag.name}</h3>
              </button>
            ))}
        </div>
      </div>
    </>
  );
}
export default ProjectTags;
