import React from 'react';
import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import ProductCard from './';

describe('ProductCard', () => {
  const product = {
    id: '1001',
    name: 'Smartphone',
    type_name: 'Eletrônicos',
  };

  const onClick = jest.fn();

  it('should render the product name and type', () => {
    render(<ProductCard product={product} onClick={onClick} />);

    const productNameElement = screen.getByText(product.name);
    const productTypeElement = screen.getByText(product.type_name);

    expect(productNameElement).toBeInTheDocument();
    expect(productTypeElement).toBeInTheDocument();
  });

  it('should call onClick when clicked', () => {
    render(<ProductCard product={product} onClick={onClick} />);

    const productCardElement = screen.getByTestId('product-card');
    userEvent.click(productCardElement);

    expect(onClick).toHaveBeenCalledTimes(1);
  });
});
