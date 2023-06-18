import React from 'react';

import formatDate from '../../utils/formatDate';
import ProductGrid from '../../Components/Organisms/ProductGrid';

import '../../styles/container.scss'
import './index.scss';
import ProductCard from '../../Components/Molecules/ProductCard';



export default function Cashier() {
  const currentDate = formatDate(new Date())

  return (
    <main className='Cashier Container'>
      <header className='Cashier-header'>
        <h1>Nova venda</h1>
        <time>{currentDate}</time>
      </header>
      <ProductGrid>
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
      </ProductGrid>
    </main>
  )
}