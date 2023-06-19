import React from 'react';
import { render, screen, fireEvent } from '@testing-library/react';
import Select from './';

const options = [
  { id: 1, name: 'Option 1' },
  { id: 2, name: 'Option 2' },
  { id: 3, name: 'Option 3' },
];

describe('Select', () => {
  test('renders select with options', () => {
    const value = 2;
    const onChange = jest.fn();

    render(
      <Select options={options} value={value} onChange={onChange} icon="GiAbstract009" label="Select an option" />
    );

    const selectElement = screen.getByTestId('select');

    expect(selectElement).toBeInTheDocument();
    expect(selectElement).toHaveValue(value.toString());
    expect(selectElement).toHaveDisplayValue('Option 2');
    expect(selectElement).toHaveTextContent('Option 1');
    expect(selectElement).toHaveTextContent('Option 2');
    expect(selectElement).toHaveTextContent('Option 3');
  });

  test('triggers onChange event', () => {
    const value = 1;
    const onChange = jest.fn();

    render(
      <Select options={options} value={value} onChange={onChange} icon="GiAbstract009" label="Select an option" />
    );

    const selectElement = screen.getByTestId('select');

    fireEvent.change(selectElement, { target: { value: '2' } });

    expect(onChange).toHaveBeenCalledTimes(1);
  });
});
