import React from 'react';
import ReactDOM from 'react-dom/client';
import { createBrowserRouter, RouterProvider } from 'react-router-dom';

import Cashier from './pages/Cashier';
import Products from './pages/Products';
import Categories from './pages/Categories';

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