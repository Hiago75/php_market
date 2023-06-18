import React from 'react';
import { render, screen } from '@testing-library/react';
import ProductCard from './';

describe('ProductCard', () => {
  const product = {
    name: 'Example Product',
    category: 'Example Category'
  };

  test('renders product card component with correct name and category', () => {
    render(<ProductCard product={product} />);
    const productCardElement = screen.getByTestId('product-card');
    const nameElement = screen.getByText(product.name);
    const categoryElement = screen.getByText(product.category);
    expect(productCardElement).toBeInTheDocument();
    expect(nameElement).toBeInTheDocument();
    expect(categoryElement).toBeInTheDocument();
  });

  test('renders product card component with correct className', () => {
    render(<ProductCard product={product} />);
    const productCardElement = screen.getByTestId('product-card');
    expect(productCardElement).toHaveClass('ProductCard');
  });
});
