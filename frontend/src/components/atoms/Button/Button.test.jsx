import React from 'react';
import { render, screen } from '@testing-library/react';
import Button from './';

describe('Button', () => {
  test('renders button with correct text', () => {
    const buttonText = 'Click me';
    render(<Button>{buttonText}</Button>);
    const buttonElement = screen.getByTestId('button');
    expect(buttonElement).toBeInTheDocument();
    expect(buttonElement).toHaveTextContent(buttonText);
  });

  test('renders button with correct className', () => {
    render(<Button>Submit</Button>);
    const buttonElement = screen.getByTestId('button');
    expect(buttonElement).toHaveClass('Button');
  });
});
