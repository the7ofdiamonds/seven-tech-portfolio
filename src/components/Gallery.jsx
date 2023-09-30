function Gallery(props) {
  console.log(props);
  return (
    <>
      <div className="gallery">
        <div className="gallery-row">
          {Array.isArray(props.gallery) && props.gallery.map((photo, index) => (
            <img key={index} className="photo" src={photo} alt="" />
          ))}
        </div>
      </div>
    </>
  );
}

export default Gallery;
