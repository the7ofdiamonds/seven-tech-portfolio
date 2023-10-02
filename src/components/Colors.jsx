import React from 'react';

function Colors(props) {
  const { colors } = props;

  return (
    <div className="colors">
      <h5 class="title">Colors ({colors.length})</h5>

      <div className="color-row">
        {Array.isArray(colors) &&
          colors.map((color, index) => (
            <div className="color" key={index}>
              <span className="color-square" style={{ backgroundColor: color }}></span>
              <h5>{color}</h5>
            </div>
          ))}
      </div>
    </div>
  );
}

export default Colors;
