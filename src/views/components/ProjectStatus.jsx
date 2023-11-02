function ProjectStatus(props) {
  const { project_status } = props;

  return (
    <>
      <div className="project-status">
        <h4>STATUS</h4>
        {project_status === '' ||
        project_status === '0' ||
        project_status === undefined ||
        project_status === null ? (
          <h5>NOT STARTED</h5>
        ) : project_status === 'ongoing' ? (
          <h5>ONGOING</h5>
        ) : (
          <>
            <progress min="0" value={project_status} max="100"></progress>
            <p>{project_status}%</p>
          </>
        )}
      </div>
    </>
  );
}

export default ProjectStatus;
