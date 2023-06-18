import React from 'react';
import { render, screen } from '@testing-library/react';
import Price from './';

describe('Price', () => {
  test('renders price component with correct label and value', () => {
    const label = 'Price:';
    const value = '$19.99';
    render(<Price label={label}>{value}</Price>);
    const priceElement = screen.getByTestId('price');
    const labelElement = screen.getByTestId('label');
    const valueElement = screen.getByTestId('price-value');
    expect(priceElement).toBeInTheDocument();
    expect(labelElement).toHaveTextContent(label);
    expect(valueElement).toHaveTextContent(value);
  });

  test('renders price component with correct className', () => {
    render(<Price label="Price:">$19.99</Price>);
    const priceElement = screen.getByTestId('price');
    expect(priceElement).toHaveClass('Price');
  });
});
