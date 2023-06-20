import React from 'react';
import { render, screen, fireEvent, waitFor } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import Categories from '.';

describe('Categories Component', () => {
  beforeEach(() => {
    jest.spyOn(global, 'fetch').mockResolvedValue({
      ok: true,
      json: jest.fn().mockResolvedValue({ data: { id: '123' } }),
    });
  });

  afterEach(() => {
    jest.restoreAllMocks();
  });

  test('renders the component', () => {
    render(<Categories />);

    const nameInput = screen.getByPlaceholderText('Nome');
    const percentageInput = screen.getByPlaceholderText('Porcentagem de impostos');
    const registerButton = screen.getByRole('button', { name: 'Registrar' });

    expect(nameInput).toBeInTheDocument();
    expect(percentageInput).toBeInTheDocument();
    expect(registerButton).toBeInTheDocument();
  });

  test('registers a new type with taxes', async () => {
    jest.spyOn(console, 'log').mockImplementation(() => {});

    render(<Categories />);

    const nameInput = screen.getByPlaceholderText('Nome');
    const percentageInput = screen.getByPlaceholderText('Porcentagem de impostos');
    const registerButton = screen.getByRole('button', { name: 'Registrar' });

    userEvent.type(nameInput, 'Test Type');
    userEvent.type(percentageInput, '10');
    fireEvent.click(registerButton);

    await waitFor(() => {
      expect(fetch).toHaveBeenCalledTimes(2);
    });

    expect(nameInput).toHaveValue('');
    expect(percentageInput).toHaveValue(null);

    expect(console.log).toHaveBeenCalledWith('Type and tax created successfully!');
  });

  test('handles error when registering a new type with taxes', async () => {
    jest.spyOn(console, 'error').mockImplementation(() => {});

    jest.spyOn(global, 'fetch').mockResolvedValueOnce({
      ok: true,
      json: jest.fn().mockResolvedValue({ data: { id: '123' } }),
    }).mockResolvedValueOnce({
      ok: false,
    });

    render(<Categories />);

    const nameInput = screen.getByPlaceholderText('Nome');
    const percentageInput = screen.getByPlaceholderText('Porcentagem de impostos');
    const registerButton = screen.getByRole('button', { name: 'Registrar' });

    userEvent.type(nameInput, 'Test Type');
    userEvent.type(percentageInput, '10');
    fireEvent.click(registerButton);

    await waitFor(() => {
      expect(fetch).toHaveBeenCalledTimes(2);
    });

    expect(nameInput).toHaveValue('');
    expect(percentageInput).toHaveValue(null);

    expect(console.error).toHaveBeenCalledWith('Error registering type and tax:', expect.any(Error));
  });
});
