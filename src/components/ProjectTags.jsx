function ProjectTags(props) {
  const { project_tags } = props;

  return (
    <>
      <div className="project-tags">
        <h4 className="title">Project Tags</h4>
        
        <div className="tag-row">
          {Array.isArray(project_tags) &&
            project_tags.map((tag, index) => (
              <h3 className="tag" key={index}>
                #{tag.name}
              </h3>
            ))}
        </div>
      </div>
    </>
  );
}
export default ProjectTags;
