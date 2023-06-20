import React from 'react';
import { render, screen, fireEvent } from '@testing-library/react';
import Input from './';

describe('Input Component', () => {
  const label = 'Name:';
  const icon = 'GiPencil';
  const type = 'text';
  const placeholder = 'Enter your name';
  const id = 'name';
  const value = 'John Doe';
  const onChange = jest.fn();

  it('should render the input element with label, icon, and value', () => {
    render(
      <Input
        label={label}
        icon={icon}
        type={type}
        placeholder={placeholder}
        id={id}
        value={value}
        onChange={onChange}
      />
    );

    const inputElement = screen.getByLabelText(label);
    const iconElement = screen.getByTestId('icon');

    expect(inputElement).toBeInTheDocument();
    expect(inputElement).toHaveAttribute('type', type);
    expect(inputElement).toHaveAttribute('placeholder', placeholder);
    expect(inputElement).toHaveAttribute('id', id);
    expect(inputElement).toHaveValue(value);
    expect(onChange).not.toHaveBeenCalled();

    expect(iconElement).toBeInTheDocument();
    expect(iconElement).toHaveClass('Input-icon');
  });

  it('should trigger onChange event when input value changes', () => {
    render(
      <Input
        label={label}
        icon={icon}
        type={type}
        placeholder={placeholder}
        id={id}
        value={value}
        onChange={onChange}
      />
    );

    const inputElement = screen.getByLabelText(label);

    fireEvent.change(inputElement, { target: { value: 'test' } });

    expect(onChange).toHaveBeenCalledTimes(1);
    expect(onChange).toHaveBeenCalledWith(expect.any(Object));
  });
});
