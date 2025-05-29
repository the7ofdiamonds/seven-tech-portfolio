import React from "react";

interface IconComponentProps {
  icon: string | object;
  url: string;
}

const IconComponent: React.FC<IconComponentProps> = ({ icon, url }) => {

  return (
    <>
      {icon instanceof Object && (
        <>
          <div className="icon">
            {icon['icon_url'] ? (
              <a href={`${url}`}>
                <img src={`${icon['icon_url']}`} />
              </a>
            ) : (
              icon['fa_icon'] && (
                <a href={`${url}`}>
                  <i className={`${icon['fa_icon']}`}></i>
                </a>
              )
            )}
          </div>
        </>
      )}
    </>
  );
}

export default IconComponent;
