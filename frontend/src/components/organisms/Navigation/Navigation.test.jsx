import React from 'react';
import { render, screen } from '@testing-library/react';
import Navigation from './';

describe('Navigation component', () => {
  it('should render navigation links', () => {
    render(<Navigation />);
    const vendaLink = screen.getByText(/Venda/i);
    const produtosLink = screen.getByText(/Produtos/i);
    expect(vendaLink).toBeInTheDocument();
    expect(produtosLink).toBeInTheDocument();
  });

  it('should have correct href attributes', () => {
    render(<Navigation />);
    const vendaLink = screen.getByText(/Venda/i);
    const produtosLink = screen.getByText(/Produtos/i);
    expect(vendaLink.getAttribute('href')).toBe('/');
    expect(produtosLink.getAttribute('href')).toBe('/products');
  });
});
