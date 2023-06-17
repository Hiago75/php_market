import React from 'react';
import ReactDOM from 'react-dom/client';
import './styles/global.scss';
import Cashier from './pages/Cashier';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <Cashier />
  </React.StrictMode>
);