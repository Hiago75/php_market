import React from 'react';
import { render, screen, fireEvent } from '@testing-library/react';
import Product from './';
import useFetchData from '../../hooks/useFetchData';

jest.mock('../../hooks/useFetchData');

describe('Product component', () => {
  beforeEach(() => {
    useFetchData.mockImplementation(() => ({
      data: {
        data: [
          { id: 1, name: 'Type 1' },
          { id: 2, name: 'Type 2' },
          { id: 3, name: 'Type 3' },
        ],
      },
      loading: false,
      error: null,
    }));
  });

  it('should render form inputs', () => {
    render(<Product />);
    const nameInput = screen.getByLabelText('Nome:');
    const typeSelect = screen.getByLabelText('Tipo:');
    const priceInput = screen.getByLabelText('Preço:');
    const registerButton = screen.getByRole('button', { name: 'Registrar' });

    expect(nameInput).toBeInTheDocument();
    expect(typeSelect).toBeInTheDocument();
    expect(priceInput).toBeInTheDocument();
    expect(registerButton).toBeInTheDocument();
  });

  it('should render product types in the select', () => {
    render(<Product />);
    const typeSelect = screen.getByLabelText('Tipo:');

    expect(typeSelect).toBeInTheDocument();
    expect(screen.getByText('Selecione um tipo')).toBeInTheDocument();

    const productTypes = screen.getAllByRole('option');
    expect(productTypes).toHaveLength(4); // 3 types + default option

    expect(productTypes[1]).toHaveValue('1');
    expect(productTypes[1]).toHaveTextContent('Type 1');
    expect(productTypes[2]).toHaveValue('2');
    expect(productTypes[2]).toHaveTextContent('Type 2');
    expect(productTypes[3]).toHaveValue('3');
    expect(productTypes[3]).toHaveTextContent('Type 3');
  });

  it('should update state when input values change', () => {
    render(<Product />);
    const nameInput = screen.getByLabelText('Nome:');
    const typeSelect = screen.getByLabelText('Tipo:');
    const priceInput = screen.getByLabelText('Preço:');

    fireEvent.change(nameInput, { target: { value: 'New Product' } });
    fireEvent.change(typeSelect, { target: { value: '2' } });
    fireEvent.change(priceInput, { target: { value: '99.99' } });

    expect(nameInput).toHaveValue('New Product');
    expect(typeSelect).toHaveValue('2');
    expect(priceInput).toHaveValue(99.99);
  });
});
