import React, { useState } from "react";
import useFetchData from 'hooks/useFetchData';

import Button from 'components/atoms/Button';
import Input from "components/molecules/Input";
import Select from "components/molecules/Select";

import 'styles/container.scss'
import './index.scss';
import Aside from "components/organisms/Aside/index";

export default function Product() {
  const [name, setName] = useState('');
  const [typeId, setTypeId] = useState('');
  const [price, setPrice] = useState('');
  
  const handleNameChange = (event) => {
    setName(event.target.value);
  };

  const handleTypeChange = (event) => {
    setTypeId(event.target.value);
  };

  const handlePriceChange = (event) => {
    setPrice(event.target.value);
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    const newProduct = { name, type_id: typeId, price };

    try {
      const response = await fetch('http://localhost:8080/products', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Origin': 'http://localhost:3000',
        },
        body: JSON.stringify(newProduct),
      });

      if (response.ok) {
        console.log('Product successfully registered!');
        setName('');
        setTypeId('');
        setPrice('');
      } else {
        console.error('Failed to register product');
      }
    } catch (error) {
      console.error('Error registering product:', error);
    }
  };


  const { data, loading, error } = useFetchData('http://localhost:8080/product-type');

  if(loading) {
    return <>loading</>
  }

  const productTypes = data.data

  return (
    <section className="Container">
      <div>1</div>
      
      <Aside>
        <form className="Product-form" onSubmit={handleSubmit}>
          <Input placeholder="Nome" icon="GiPencil" type="text" id="name" value={name} onChange={handleNameChange} />

          <div>
            <Select options={productTypes} value={typeId} onChange={handleTypeChange} label="Selecione um tipo"/>
          </div>

          <Input label="Preço" icon="GiPriceTag" type="number" placeholder="Preço" id="price" value={price} onChange={handlePriceChange} />
          <Button name="Registrar" type="submit">Registrar</Button>
        </form>
      </Aside>
    </section>
  )
}