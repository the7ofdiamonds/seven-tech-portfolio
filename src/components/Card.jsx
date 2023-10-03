function Card(props) {
  const { text } = props;

  return <>{text ? <div className="card">{text}</div> : ''}</>;
}

export default Card;
