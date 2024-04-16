import React, { useEffect, useRef } from 'react';

function Technologies(props) {
  const { technologies } = props;

  return (
    <>
      {Array.isArray(technologies) && technologies.length > 0 ? (
        <div className="technologies">
          {technologies.map((tech, index) => (
            <i
              key={index}
              className={`fa-brands fa-${tech['icon']}`}></i>
          ))}
        </div>
      ) : (
        ''
      )}
    </>
  );
}

export default Technologies;
