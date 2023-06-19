import React, { useState } from "react";
import useFetchData from '../../hooks/useFetchData';

import '../../styles/container.scss'

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
      <form onSubmit={handleSubmit}>
        <div>
          <label htmlFor="name">Nome:</label>
          <input type="text" id="name" value={name} onChange={handleNameChange} />
        </div>

        <div>
          <label htmlFor="type">Tipo:</label>
          <select id="type" value={typeId} onChange={handleTypeChange}>
            <option value="">Selecione um tipo</option>
            {productTypes.map((type) => (
              <option key={type.id} value={type.id}>
                {type.name}
              </option>
            ))}
          </select>
        </div>

        <div>
          <label htmlFor="price">Preço:</label>
          <input type="number" id="price" value={price} onChange={handlePriceChange} />
        </div>

        <button name="Registrar" type="submit">Registrar</button>
      </form>
    </section>
  )
}