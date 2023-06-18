import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import CircleButton from './';

describe('CircleButton', () => {
  test('renders button with correct text content', () => {
    const buttonText = 'Click me';
    render(<CircleButton>{buttonText}</CircleButton>);
    const buttonElement = screen.getByText(buttonText);

    expect(buttonElement).toBeInTheDocument();
  });

  test('renders button with correct color', () => {
    const buttonColor = 'red';
    render(<CircleButton color={buttonColor}>Button</CircleButton>);
    const buttonElement = screen.getByText('Button');

    expect(buttonElement).toHaveStyle({ color: buttonColor });
  });
});
