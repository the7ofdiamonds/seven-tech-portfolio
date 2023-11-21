import React from 'react';

function Modal(props) {
  const { message } = props;

  return (
    <>
      {message && (
        <span className="overlay">
          <div className="status-bar card success modal">
            <h4>{message}</h4>
          </div>
        </span>
      )}
    </>
  );
}

export default Modal;
