import React, { useState } from 'react';

import formatDate from '../../utils/formatDate';
import ProductGrid from '../../Components/Organisms/ProductGrid';

import '../../styles/container.scss'
import './index.scss';
import ProductCard from '../../Components/Molecules/ProductCard';
import Cart from '../../Components/Organisms/Cart';
import ProductLine from '../../Components/Molecules/ProductLine';

export default function Cashier() {
  const currentDate = formatDate(new Date())
  const [selectedProducts, setSelectedProducts] = useState([]);

  const handleProductClick = (product) => {
    setSelectedProducts((prevSelectedProducts) => [...prevSelectedProducts, product]);
  }

  const mockProducts = [
    {name: 'Phone', category: 'Eletrônicos', price: '$12'},
    {name: 'Leggins', category: 'Roupas', price: '$8'},
    {name: 'Melon', category: 'Alimentos', price: '$8'},
    {name: 'Mouse', category: 'Eletrônicos', price: '$12'},
    {name: 'T-shirt', category: 'Roupas', price: '$5'},
    {name: 'Hat', category: 'Roupas', price: '$5'},
    {name: 'Banana', category: 'Alimentos', price: '$8'},
    {name: 'Keyboard', category: 'Eletrônicos', price: '$12'},
  ]

  return (
    <main className='Cashier Container'>
      <section>
        <header className='Cashier-header'>
          <h1>Nova venda</h1>
          <time>{currentDate}</time>
        </header>
        <ProductGrid>
          {mockProducts.map((product) => (
            <ProductCard key={product.name} onClick={() => handleProductClick(product)} product={product} />
          ))}
        </ProductGrid>
      </section>
      <Cart>
        {selectedProducts.map((product) => (
          <ProductLine key={product.name} product={product}/>
        ))}
      </Cart>
    </main>
  )
}