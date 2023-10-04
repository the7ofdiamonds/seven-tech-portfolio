function Gallery(props) {
  return (
    <>
      {props.gallery && props.gallery.length > 0 ? (
        <div className="gallery">
          <div className="gallery-row">
            {Array.isArray(props.gallery) &&
              props.gallery.map((photo, index) => (
                <span className="gallery-photo">
                  <img key={index} className="photo" src={photo} alt="" />
                </span>
              ))}
          </div>
        </div>
      ) : (
        ''
      )}
    </>
  );
}

export default Gallery;
