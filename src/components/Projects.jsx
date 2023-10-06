import React from 'react';

import Gallery from '../components/Gallery';
import ProjectStatus from '../components/ProjectStatus';

function Projects(props) {
  const { projects } = props;

  return (
    <>
      {projects && projects.length > 0
        ? projects.map((project, index) => (
            <div key={index} className="project card">
              <h3>{project.title}</h3>
              <Gallery gallery={project.solution_gallery} />
              <ProjectStatus project_status={project.project_status} />
            </div>
          ))
        : 'There are no projects to display'}
    </>
  );
}

export default Projects;
