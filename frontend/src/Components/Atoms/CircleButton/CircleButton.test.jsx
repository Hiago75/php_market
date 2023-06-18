import React from 'react';
import { render, fireEvent, screen } from '@testing-library/react';
import CircleButton from './';

describe('CircleButton', () => {
  test('should render button with correct label', () => {
    const label = 'Add';
    render(
      <CircleButton label={label} color="blue">
        +
      </CircleButton>
    );

    const button = screen.getByLabelText(label);
    expect(button).toBeInTheDocument();
  });

  test('should call onClick function when button is clicked', () => {
    const onClick = jest.fn();
    render(
      <CircleButton label="Add" color="blue" onClick={onClick}>
        +
      </CircleButton>
    );

    const button = screen.getByLabelText('Add');
    fireEvent.click(button);

    expect(onClick).toHaveBeenCalledTimes(1);
  });

  test('should disable the button when disabled prop is true', () => {
    const onClick = jest.fn();
    render(
      <CircleButton label="Add" color="blue" onClick={onClick} disabled>
        +
      </CircleButton>
    );

    const button = screen.getByLabelText('Add');
    expect(button).toBeDisabled();
  });
});
