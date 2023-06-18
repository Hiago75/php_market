import React, { useState } from 'react';

import formatDate from '../../utils/formatDate';
import ProductGrid from '../../Components/Organisms/ProductGrid';

import '../../styles/container.scss'
import './index.scss';
import ProductCard from '../../Components/Molecules/ProductCard';
import Cart from '../../Components/Organisms/Cart';


const mockProducts = [
  {name: 'Phone', category: 'Eletrônicos', price: 12 , taxesPercentage: '12'},
  {name: 'Leggins', category: 'Roupas', price: 8, taxesPercentage: 8},
  {name: 'Melon', category: 'Alimentos', price: 8, taxesPercentage: 5},
  {name: 'Mouse', category: 'Eletrônicos', price: 12, taxesPercentage: 12},
  {name: 'T-shirt', category: 'Roupas', price: 5, taxesPercentage: 12},
  {name: 'Hat', category: 'Roupas', price: 5, taxesPercentage: 8},
  {name: 'Banana', category: 'Alimentos', price: 8, taxesPercentage: 5},
  {name: 'Keyboard', category: 'Eletrônicos', price: 12, taxesPercentage: 12},
]


export default function Cashier() {
  const currentDate = formatDate(new Date())
  const [selectedProducts, setSelectedProducts] = useState([]);

  const handleProductClick = (product) => {
    const isProductSelected = selectedProducts.some(
      (selectedProduct) => selectedProduct.name === product.name
    );
  
    if (!isProductSelected) {
      const productWithQuantity = {
        ...product,
        quantity: 1, 
      };

      setSelectedProducts((prevSelectedProducts) => [
        ...prevSelectedProducts,
        productWithQuantity,
      ]);
    }
  };
  
  
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

      <Cart selectedProducts={selectedProducts} setSelectedProducts={setSelectedProducts} />
    </main>
  )
}