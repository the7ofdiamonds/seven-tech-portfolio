import React, { useEffect, useRef } from 'react';

import IconComponent from './IconComponent';

function ProjectSkills(props) {
  const { skills } = props;

  return (
    <>
      {Array.isArray(skills) && skills.length > 0 && (
        <div className="technologies">
          {skills.map((tech, index) => (
            <IconComponent key={index} icon={tech.icon} url={tech.url}/>
          ))}
        </div>
      )}
    </>
  );
}

export default ProjectSkills;
