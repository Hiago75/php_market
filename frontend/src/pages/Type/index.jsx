import React, { useState } from 'react';

export default function Type() {
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

    try {
      const typeResponse = await fetch('http://localhost:8080/types', {
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
      const typeId = newType.id;

      const taxResponse = await fetch('http://localhost:8080/taxes', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ type_id: typeId, percentage }),
      });

      if (!taxResponse.ok) {
        throw new Error('Failed to create tax');
      }

      setName('');
      setPercentage('');

      console.log('Type and tax created successfully!');
    } catch (error) {
      console.error('Error registering type and tax:', error);
    }
  };

  return (
    <section className='Container'>
      <div>
        <h2>Register New Type with Taxes</h2>
        <form onSubmit={handleSubmit}>
          <div>
            <label htmlFor="name">Name:</label>
            <input type="text" id="name" value={name} onChange={handleNameChange} />
          </div>
          <div>
            <label htmlFor="percentage">Percentage:</label>
            <input type="number" id="percentage" value={percentage} onChange={handlePercentageChange} />
          </div>
          <button type="submit">Register</button>
        </form>
      </div>
    </section>
  );
}