import React, { useState } from 'react';
import Input from '../../Components/Molecules/Input';
import Button from '../../Components/Atoms/Button';

import './index.scss';

export default function Categories() {
  const [name, setName] = useState('');
  const [percentage, setPercentage] = useState('');

  const handleNameChange = (event) => {
    setName(event.target.value);
  };

  const handlePercentageChange = (event) => {
    setPercentage(event.target.value);
  };

  const handleSubmit = async (event) => {
    event.preventDefault();

    // TODO: refactor
    try {
      const typeResponse = await fetch('http://localhost:8080/product-type', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name }),
      });

      if (!typeResponse.ok) {
        throw new Error('Failed to create type');
      }

      const newType = await typeResponse.json();
      const typeId = newType.data.id;

      const taxResponse = await fetch('http://localhost:8080/taxes', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ type_id: typeId, percentage }),
      });

      setName('');
      setPercentage('');

      if (!taxResponse.ok) {
        throw new Error('Failed to create tax');
      }

      console.log('Type and tax created successfully!');
    } catch (error) {
      console.error('Error registering type and tax:', error);
    }
  };

  return (
    <section className='Container'>
      <h2>Register New Type with Taxes</h2>
      
      <form className='Categories-form' onSubmit={handleSubmit}>
        <Input icon="GiPencil" type="text" placeholder="Nome" id="name" value={name} onChange={handleNameChange} />
        
        <Input icon="AiOutlinePercentage" placeholder="Porcentagem de impostos" type="number" id="percentage" value={percentage} onChange={handlePercentageChange} />

        <Button name="Registrar" type="submit">Registrar</Button>
      </form>
    </section>
  );
}