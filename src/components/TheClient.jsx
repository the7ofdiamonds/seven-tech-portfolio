import React from 'react';

function TheClient(props) {
  console.log(props);
  const { the_client } = props;

  return (
    <>
      <div className="the-client">
        <span className="client-name">
          <label htmlFor="clientName">Client Name:</label>
          <h4>{the_client.client_name}</h4>
        </span>
        <span>
          {the_client.start_date} to {the_client.end_date}
        </span>
      </div>
    </>
  );
}

export default TheClient;
