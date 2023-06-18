import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import ProductCard from './';

jest.mock('../../Atoms/Icon', () => ({ icon, className }) => (
  <div data-testid="mock-icon" className={className}>
    Mock Icon Component ({icon})
  </div>
));

jest.mock('../../../utils/productTypeIconMap', () => ({
  productTypeIconMap: {
    'Product Category': 'mock-icon-name',
  },
}));

describe('ProductCard', () => {
  test('renders product name and category', () => {
    const mockProduct = {
      name: 'Product Name',
      category: 'Product Category',
    };

    render(<ProductCard product={mockProduct} />);
    const productNameElement = screen.getByText(mockProduct.name);
    const productCategoryElement = screen.getByText(mockProduct.category);

    expect(productNameElement).toBeInTheDocument();
    expect(productCategoryElement).toBeInTheDocument();
  });

  test('renders the correct icon based on the product category', () => {
    const mockProduct = {
      name: 'Product Name',
      category: 'Product Category',
    };

    render(<ProductCard product={mockProduct} />);
    const iconElement = screen.getByTestId('mock-icon');

    expect(iconElement).toBeInTheDocument();
    expect(iconElement).toHaveClass('ProductCard-icon__figure');
    expect(iconElement).toHaveTextContent('Mock Icon Component (mock-icon-name)');
  });
});
