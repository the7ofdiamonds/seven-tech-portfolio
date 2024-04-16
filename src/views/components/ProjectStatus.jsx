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
          <h4>NOT STARTED</h4>
        ) : project_status === 'ongoing' ? (
          <h4>ONGOING</h4>
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
