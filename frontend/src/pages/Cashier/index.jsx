import React from 'react';

import formatDate from '../../utils/formatDate';
import ProductGrid from '../../Components/Organisms/ProductGrid';

import '../../styles/container.scss'
import './index.scss';
import ProductCard from '../../Components/Molecules/ProductCard';
import Cart from '../../Components/Organisms/Cart';
import ProductLine from '../../Components/Molecules/ProductLine';

export default function Cashier() {
  const currentDate = formatDate(new Date())

  return (
    <main className='Cashier Container'>
      <section>
        <header className='Cashier-header'>
          <h1>Nova venda</h1>
          <time>{currentDate}</time>
        </header>
        <ProductGrid>
          <ProductCard product={{name: 'Melon', category: 'Eletrônicos'}} />
          <ProductCard product={{name: 'Melon', category: 'Roupas'}} />
          <ProductCard product={{name: 'Melon', category: 'Alimentos'}} />
          <ProductCard product={{name: 'Melon', category: 'Eletrônicos'}} />
          <ProductCard product={{name: 'Melon', category: 'Roupas'}} />
          <ProductCard product={{name: 'Melon', category: 'Roupas'}} />
          <ProductCard product={{name: 'Melon', category: 'Alimentos'}} />
          <ProductCard product={{name: 'Melon', category: 'Eletrônicos'}} />
        </ProductGrid>
      </section>
      <Cart>
        <ProductLine />
        <ProductLine />
        <ProductLine />
        <ProductLine />
      </Cart>
    </main>
  )
}