function Versions(props) {
  const { project_versions } = props;

  return (
    <>
      {project_versions ? (
        <div className="versions">
          <span className="current-version">
            <h4>Current Version</h4>
            {project_versions.current}
          </span>

          <span className="upcoming-versions">
            <h4>Upcoming Versions</h4>
            <table>
              <tbody>
                {Array.isArray(project_versions.upcoming) &&
                  project_versions.upcoming.map((version, index) => (
                    <tr key={index}>
                      <td className="feature">{version.feature}</td>
                      <td>-</td>
                      <td>{version.version_number}</td>
                    </tr>
                  ))}
              </tbody>
            </table>
          </span>
        </div>
      ) : (
        ''
      )}
    </>
  );
}

export default Versions;
