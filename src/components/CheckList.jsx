function CheckList(props) {
  console.log(props);
  const { checklist } = props;
  return (
    <>
      {checklist ? (
        <div className="checklist">
          {Array.isArray(checklist) &&
            checklist.map((item, index) => (
              <span>
                <input key={index} type="checkbox" name="" id="" />
                <h4>{item}</h4>
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
