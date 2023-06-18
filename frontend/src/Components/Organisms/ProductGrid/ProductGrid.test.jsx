import React from 'react';
import { render, screen } from '@testing-library/react';
import ProductGrid from './';

describe('ProductGrid', () => {
  it('should render the product grid with children', () => {
    render(
      <ProductGrid>
        <div>Product 1</div>
        <div>Product 2</div>
        <div>Product 3</div>
      </ProductGrid>
    );

    const productElements = screen.getAllByText(/^Product \d$/);
    expect(productElements.length).toBe(3);
  });

  it('should render the product grid without children', () => {
    render(<ProductGrid />);
    const productGridElement = screen.getByTestId('product-grid');
    expect(productGridElement).toBeInTheDocument();
  });
});
