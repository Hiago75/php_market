import React from 'react';
import { render, screen } from '@testing-library/react';
import Cashier from '.';
import formatDate from '../../utils/formatDate';

jest.mock('../../utils/formatDate');

describe('Cashier', () => {
  beforeAll(() => {
    const mockDate = new Date('2023-06-17T12:34:56');
    formatDate.mockReturnValue('Sat, 17 Jun 2023');
    global.Date = jest.fn(() => mockDate);
  });

  afterAll(() => {
    global.Date = Date;
  });

  it('should render correctly', () => {
    render(<Cashier />);
    expect(screen.getByText(/Nova venda/i)).toBeInTheDocument();
  });
});
