import React from 'react';
import ReactDOM from 'react-dom/client';
import { createBrowserRouter, RouterProvider, Link } from 'react-router-dom';

import Cashier from './pages/Cashier';
import Product from './pages/Product';

import './styles/global.scss';
import './styles/container.scss';
import Navigation from './Components/Organisms/Navigation';

const router = createBrowserRouter([
  {
    'path': '/',
    element: <Cashier />
  },
  {
    'path': '/products',
    element: <Product />
  }
])

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <section className='Grid'>
      <Navigation />

      <RouterProvider router={router} />
    </section>
  </React.StrictMode>,
);