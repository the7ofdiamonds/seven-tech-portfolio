function ProjectType(props) {
  const handleClick = (slug) => {
    const url = window.location.origin;

    window.open(`${url}/portfolio/${slug}`, '_blank');
  };

  return (
    <>
      <div class="project-type">
        <h3>Type</h3>
        {Array.isArray(props.project_types) &&
          props.project_types.map((project_type, index) => (
            <button
              className="category"
              onClick={() => handleClick(project_type.slug)}
              key={index}>
              <h3>{project_type.name}</h3>
            </button>
          ))}
      </div>
    </>
  );
}

export default ProjectType;
