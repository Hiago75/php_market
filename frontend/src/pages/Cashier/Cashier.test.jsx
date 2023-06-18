import React from 'react';
import { fireEvent, render, screen } from '@testing-library/react';
import Cashier from './';

jest.mock('../../hooks/useFetchData', () => ({
  __esModule: true,
  default: () => ({
    data: {
      data: [
        {
          id: '1001',
          name: 'Smartphone',
          type_id: '1',
          price: '1200.00',
          type_name: 'Eletrônicos',
          tax_percentage: '18.00',
        },
        {
          id: '1002',
          name: 'TV LED',
          type_id: '1',
          price: '1500.00',
          type_name: 'Eletrônicos',
          tax_percentage: '18.00',
        },
      ],
    },
    loading: false,
    error: null,
  }),
}));

describe('Cashier component', () => {
  beforeEach(() => {
    jest.clearAllMocks();
  })

  it('should render product cards', () => {
    render(<Cashier />);
    const productCardElements = screen.getAllByTestId('product-card');
    expect(productCardElements).toHaveLength(2);
  });

  it('should handle product click', () => {
    render(<Cashier />);
    const productCardElements = screen.getAllByTestId('product-card');
    const productCardElement = productCardElements.find(card => card.getAttribute('data-product-id') === '1001');
  
    fireEvent.click(productCardElement);
  
    const productLine = screen.getAllByTestId('product-line');
    const productLineElement = productLine.find(card => card.getAttribute('data-product-id') === '1001');
    expect(productLineElement).toBeInTheDocument();
  });
});