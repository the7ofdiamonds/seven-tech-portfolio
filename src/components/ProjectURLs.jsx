import React from 'react';

function ProjectURLs(props) {
  console.log(props);

  const { project_urls } = props;

  return (
    <>
      <div className="project-urls">
        {Object.keys(project_urls).map((key, index) => (
          <button key={index} onClick={() => window.open(project_urls[key].url, '_blank')}>
            <i className={`${project_urls[key].icon}`}></i>
          </button>
        ))}
      </div>
    </>
  );
}

export default ProjectURLs;
