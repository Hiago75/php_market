import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom/extend-expect';
import Icon from './';

jest.mock('react-icons/gi', () => ({
  GiExampleIcon: ({ className }) => (
    <div data-testid="mock-icon" className={className} />
  ),
}));

describe('Icon', () => {
  const icon = 'GiExampleIcon';
  const className = 'test-icon';

  test('renders the correct icon with the provided className', () => {
    render(<Icon icon={icon} className={className} />);
    const iconElement = screen.getByTestId('mock-icon');

    expect(iconElement).toBeInTheDocument();
    expect(iconElement).toHaveClass(className);
  });
});
