import React from 'react';

import IconComponent from './IconComponent';

function HeaderIconComponent(props) {
  const { title, icon, url } = props;

  return (
    <div className="header-icon">
      {title ? (
        <>
          <IconComponent icon={icon} url={url} />
          <h1 className="title">{title}</h1>
        </>
      ) : (
        <IconComponent icon={icon} url={url} />
      )}
    </div>
  );
}

export default HeaderIconComponent;
