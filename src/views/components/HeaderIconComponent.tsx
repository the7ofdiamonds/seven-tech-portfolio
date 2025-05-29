import React from 'react';

import IconComponent from './IconComponent';

interface HeaderIconComponentProps {
  title: string;
  icon: string;
  url: string;
}

const HeaderIconComponent: React.FC<HeaderIconComponentProps> = ({ title, icon, url }) => {

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
