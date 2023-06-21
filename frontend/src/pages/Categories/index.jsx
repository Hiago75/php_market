import React, { useState } from 'react';
import { toast }  from 'react-toastify';

import Toast from 'components/molecules/Toast/index';
import Aside from 'components/organisms/Aside/index';
import Input from 'components/molecules/Input';
import Button from 'components/atoms/Button';

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
      const typeResponse = await toast.promise(
        fetch('http://localhost:8080/product-type', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ name }),
        }),
        {
          pending: 'Um momento...',
          success: 'Categoria registrado',
          error: 'Opa, parece que algo deu errado.'
        }
      )

      if (!typeResponse.ok) {
        throw new Error('Failed to create type');
      }

      const newType = await typeResponse.json();
      const typeId = newType.data.id;

      const taxResponse = await toast.promise(
        fetch ('http://localhost:8080/taxes', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ type_id: typeId, percentage }),
      }), 
      {
        pending: 'Um momento...',
        success: 'Porcentagem de impostos registrada',
        error: 'Opa, parece que algo deu errado.'
      }
      );

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
      
      <Aside>
        <Toast />
        <form className='Categories-form' onSubmit={handleSubmit}>
          <Input icon="GiPencil" type="text" placeholder="Nome" id="name" value={name} onChange={handleNameChange} />
          
          <Input icon="AiOutlinePercentage" placeholder="Porcentagem de impostos" type="number" id="percentage" value={percentage} onChange={handlePercentageChange} />

          <Button name="Registrar" type="submit">Registrar</Button>
        </form>
      </Aside>
    </section>
  );
}
