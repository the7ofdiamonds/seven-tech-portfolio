import React from 'react';
import ReactDOM from 'react-dom';

import { Provider } from 'react-redux';
import store from './model/store.js';

import App from './App.jsx';

const portfolio = document.getElementById('seven_tech_portfolio');
if (portfolio) {
  ReactDOM.render(
    <React.StrictMode>
      <Provider store={store}>
        <App />
      </Provider>
    </React.StrictMode>,
    portfolio
  );
}
