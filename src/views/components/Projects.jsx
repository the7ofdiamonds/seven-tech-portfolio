import React from 'react';

import Gallery from './Gallery';
import ProjectStatus from './ProjectStatus';
import ProjectSkills from './ProjectSkills';
import ProjectDescription from './ProjectDescription';

function Projects(props) {
  const { projects } = props;

  return (
    <>
      {projects && projects.length > 0
        ? projects.map((project, index) => (
            <a href={`${project.url}`}>
              <div key={index} className="project-card card">
                <h2>{project.title}</h2>
                <Gallery gallery={project.gallery} />

                <ProjectStatus project_status={project.project_status} />

                <ProjectSkills skills={project.skills} />

                <ProjectDescription description={project.description} />
              </div>
            </a>
          ))
        : 'There are no projects to display'}
    </>
  );
}

export default Projects;
