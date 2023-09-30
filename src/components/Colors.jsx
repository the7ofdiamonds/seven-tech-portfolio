import React from 'react';

function Colors(props) {
  console.log(props);
  const { colors } = props;
  return (
    <div className="colors">
      <h3 class="title">Colors</h3>

      <div className="color-row">
        {Array.isArray(colors) &&
          colors.map((color, index) => (
            <span className='color' key={index} style={{ backgroundColor: color }}></span>
          ))}
      </div>
    </div>
  );
}

export default Colors;
