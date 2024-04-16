import React from 'react';

import Gallery from './Gallery';
import ProjectStatus from './ProjectStatus';
import Technologies from './Technologies';

function Projects(props) {
  const { projects } = props;

  return (
    <>
      {projects && projects.length > 0
        ? projects.map((project, index) => (
            <a href={`${project.url}`}>
              <div key={index} className="project card">
                <h3>{project.title}</h3>
                <Gallery gallery={project.solution_gallery} />

                <ProjectStatus project_status={project.project_status} />
                <Technologies technologies={project.technologies} />
              </div>
            </a>
          ))
        : 'There are no projects to display'}
    </>
  );
}

export default Projects;
