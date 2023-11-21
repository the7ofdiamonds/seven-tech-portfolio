import React from 'react';

function Modal(props) {
  const { problemMessage, display } = props;

  return (
    <>
      {problemMessage && (
        <span className="overlay" style={{ display: `${display}` }}>
          <div className="status-bar card success modal">
            <h4>{problemMessage}</h4>
          </div>
        </span>
      )}
    </>
  );
}

export default Modal;
