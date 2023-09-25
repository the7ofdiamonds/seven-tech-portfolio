import React from 'react';
import ReactDOM from 'react-dom';
import App from './App.jsx';
import { BrowserRouter as Router, Route } from 'react-router-dom';
import { Provider } from 'react-redux';
import store from './model/store.js';

const thfwContainer = document.getElementById('thfw_portfolio');
if (thfwContainer) {
  ReactDOM.render(
    <React.StrictMode>
      <Provider store={store}>
        <App />
      </Provider>
    </React.StrictMode>,
    thfwContainer
  );
} else {
  console.log('Container not available.');
}
