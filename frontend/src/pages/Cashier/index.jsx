import React from 'react';

import formatDate from '../../utils/formatDate';
import '../../styles/container.scss'
import './index.scss';


export default function Cashier() {
  const currentDate = formatDate(new Date())

  return (
    <main className='Cashier Container'>
      <header className='Cashier-header'>
        <h1>Nova venda</h1>
        <time>{currentDate}</time>
      </header>
    </main>
  )
}