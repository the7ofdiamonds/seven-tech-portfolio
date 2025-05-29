import React from 'react';
import ReactDOM from 'react-dom/client';
import { Provider } from 'react-redux';

import App from './App';

import store from '@/model/store';

import { initializeConfig } from '@/services/Config';

initializeConfig();

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
