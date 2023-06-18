import React from "react";
import {render, screen} from '@testing-library/react';
import ProductLine from './';

describe('ProductLine', () => {
  it('should render the card with name and price', () => {
    render(<ProductLine />);

    const productLineElement = screen.getByTestId('product-line')
    const title = screen.getByTestId('product-line__title')
    const price = screen.getByTestId('product-line__price')

    expect(productLineElement).toBeInTheDocument();
    expect(title).toBeInTheDocument();
    expect(price).toBeInTheDocument();
  })
})