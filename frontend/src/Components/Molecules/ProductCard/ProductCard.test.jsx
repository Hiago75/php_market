import React from 'react';
import { render, screen } from '@testing-library/react';
import Product from './';

describe('Product', () => {
  it('should render the product card with correct name', () => {
    render(<Product />);
    const productNameElement = screen.getByText('Product name');
    expect(productNameElement).toBeInTheDocument();
  });

  it('should render the product card with an icon', () => {
    render(<Product />);
    const productIconElement = screen.getByTestId('product-icon');
    expect(productIconElement).toBeInTheDocument();
  });
});
