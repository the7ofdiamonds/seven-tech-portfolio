import React, { useState } from 'react';

function Gallery(props) {
  const [currentPhotoIndex, setCurrentPhotoIndex] = useState(0);

  const previousPhoto = () => {
    if (currentPhotoIndex > 0) {
      setCurrentPhotoIndex(currentPhotoIndex - 1);
    }
  }

  const nextPhoto = () => {
    if (currentPhotoIndex < props.gallery.length - 1) {
      setCurrentPhotoIndex(currentPhotoIndex + 1);
    }
  }

  return (
    <>
      {props.gallery && props.gallery.length > 0 ? (
        <div className="gallery">
          <button className="arrow-left" onClick={previousPhoto}>
            <h2>V</h2>
          </button>

          <div className="gallery-row">
            {Array.isArray(props.gallery) && (
              <span className="gallery-photo">
                <img className="photo" src={props.gallery[currentPhotoIndex]} alt="" />
              </span>
            )}
          </div>

          <button className="arrow-right" onClick={nextPhoto}>
            <h2>V</h2>
          </button>
        </div>
      ) : (
        ''
      )}
    </>
  );
}

export default Gallery;
