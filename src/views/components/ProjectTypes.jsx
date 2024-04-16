function ProjectType(props) {
  const { project_types } = props;

  const handleClick = (slug) => {
    window.open(`${slug}`);
  };

  return (
    Array.isArray(project_types) && (
      <div class="project-type">
        <h4 className="title">Project Types</h4>

        <div className="project-type-row">
          {project_types.map((project_type, index) => (
            <button onClick={() => handleClick(project_type.url)} key={index}>
              <h3 className="title">{project_type.name}</h3>
            </button>
          ))}
        </div>
      </div>
    )
  );
}

export default ProjectType;
