import React from 'react';
import ReactDOM from 'react-dom/client';
import { createBrowserRouter, RouterProvider } from 'react-router-dom';

import Cashier from './pages/Cashier';
import Products from './pages/Products';
import Categories from './pages/Categories';
import Navigation from 'components/organisms/Navigation';

import './styles/global.scss';
import './styles/container.scss';

const router = createBrowserRouter([
  {
    'path': '/',
    element: <Cashier />
  },
  {
    'path': '/products',
    element: <Products />
  },
  {
    'path': '/categories',
    element: <Categories />
  }
])

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <main className='Grid'>
      <Navigation />

      <RouterProvider router={router} />
    </main>
  </React.StrictMode>,
);