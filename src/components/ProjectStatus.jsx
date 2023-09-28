function ProjectStatus(props) {
  return (
    <>
      <div class="project-status">
        <h2>Status</h2>
        <progress class="status-bar" value={props.project_status} max="100"></progress>
      </div>
    </>
  );
}

export default ProjectStatus;
