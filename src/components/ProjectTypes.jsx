function ProjectType(props) {
  const {project_types} = props;

  const handleClick = (slug) => {
    window.open(`${slug}`);
  };
console.log(project_types);
  return (
    <>
      <div class="project-type">
        <h4 className="title">Project Types</h4>

        <div className="project-type-row">
          {Array.isArray(project_types) &&
            project_types.map((project_type, index) => (
              <button
                className="category"
                onClick={() => handleClick(project_type.slug)}
                key={index}>
                <h3>{project_type.name}</h3>
              </button>
            ))}
        </div>
      </div>
    </>
  );
}

export default ProjectType;
