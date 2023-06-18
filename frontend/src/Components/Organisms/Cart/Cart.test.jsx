import React from 'react';
import { render, screen } from '@testing-library/react';
import Cart from './';

describe('Cart', () => {
  it('should render the cart with header, items, and footer', () => {
    render(
      <Cart>
        <li>Item 1</li>
        <li>Item 2</li>
      </Cart>
    );

    const cartElement = screen.getByTestId('cart');
    const headerElement = screen.getByText('Carrinho');
    const items = screen.getAllByRole('listitem');
    const footerElement = screen.getByTestId('cart-footer');

    expect(cartElement).toBeInTheDocument();
    expect(headerElement).toBeInTheDocument();
    expect(items.length).toBe(2);
    expect(footerElement).toBeInTheDocument();
  });

  it('should render the cart without items', () => {
    render(<Cart />);
    const cartElement = screen.getByTestId('cart');
    expect(cartElement).toBeInTheDocument();
  });
});
