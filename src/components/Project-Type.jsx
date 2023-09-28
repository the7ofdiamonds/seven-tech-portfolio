function ProjectType(projectType) {
  return (
    <>
      <div class="project-type">
        <h3>Type</h3>
        <button class="category" onclick="">
          <h3>{projectType}</h3>
        </button>
      </div>
    </>
  );
}

export default ProjectType;
