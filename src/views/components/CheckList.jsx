function CheckList(props) {
  const { checklist } = props;

  return (
    <>
      {checklist ? (
        <div className="checklist">
          {Array.isArray(checklist) &&
            checklist.map((task, index) => (
              <span key={index}>
                <input
                  type="checkbox"
                  name={`task_${index}`}
                  id={`task_${index}`}
                  checked={task.status}
                />
                <h4>{task.name}</h4>
              </span>
            ))}
        </div>
      ) : (
        ''
      )}
    </>
  );
}

export default CheckList;
