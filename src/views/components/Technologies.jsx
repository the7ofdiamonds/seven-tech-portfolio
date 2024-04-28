import React, { useEffect, useRef } from 'react';

import IconComponent from './IconComponent';

function Technologies(props) {
  const { technologies } = props;

  return (
    <>
      {Array.isArray(technologies) && technologies.length > 0 && (
        <div className="technologies">
          {technologies.map((tech, index) => (
            <IconComponent key={index} icon={tech['icon']} />
          ))}
        </div>
      )}
    </>
  );
}

export default Technologies;
