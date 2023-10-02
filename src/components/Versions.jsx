function Versions(props) {
  const { versions } = props;
  return (
    <>
      <div className="versions">
        <span className="current-version">
          <h4>Current Version</h4>
          {versions.current}
        </span>

        <span className="upcoming-versions">
          <h4>Upcoming Versions</h4>
          <table>
            <tbody>
              {Array.isArray(versions.upcoming) &&
                versions.upcoming.map((version, index) => (
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
    </>
  );
}

export default Versions;
