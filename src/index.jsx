import React from 'react';
import ReactDOM from 'react-dom';
import App from './App.jsx';

import { Provider } from 'react-redux';
import store from './model/store.js';

import { initializeConfig } from './services/Config.js';

initializeConfig();
console.log('Initializing Config...')

const portfolio = document.getElementById('seven_tech_portfolio');
if (portfolio) {
  ReactDOM.createRoot(portfolio).render(
    <React.StrictMode>
      <Provider store={store}>
        <App />
      </Provider>
    </React.StrictMode>
  );
}
