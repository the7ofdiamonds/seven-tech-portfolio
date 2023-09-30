function Versions(props) {
  console.log(props);
  const { versions } = props;
  console.log(versions);
  return (
    <>
      <div className="versions">
        <h4>Versions</h4>
        {Array.isArray(versions) &&
          versions.map((version, index) => (
            <p key={index}>
              {version.feature} - {version.version_number}
            </p>
          ))}
      </div>
    </>
  );
}

export default Versions;
