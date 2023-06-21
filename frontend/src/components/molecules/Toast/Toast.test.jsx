import React from 'react';
import { render } from '@testing-library/react';
import Toast from './';

jest.mock('react-toastify', () => {
  return {
    __esModule: true,
    ToastContainer: jest.fn(() => null),
  };
});

describe('Toast', () => {
  it('renders ToastContainer with default options', () => {
    const MockedToastContainer = require('react-toastify').ToastContainer;
    render(<Toast />);
    expect(MockedToastContainer).toHaveBeenCalledTimes(1);
    expect(MockedToastContainer).toHaveBeenCalledWith(
      expect.objectContaining({
        position: 'top-center',
        autoClose: 3000,
        hideProgressBar: false,
        newestOnTop: false,
        closeOnClick: true,
        rtl: false,
        pauseOnFocusLoss: true,
        draggable: true,
        pauseOnHover: true,
        theme: 'colored',
      }),
      expect.any(Object)
    );
  });

  it('renders ToastContainer with custom options', () => {
    const MockedToastContainer = require('react-toastify').ToastContainer;
    const customOptions = {
      position: 'bottom-right',
      autoClose: 5000,
      hideProgressBar: true,
      newestOnTop: true,
      closeOnClick: false,
      rtl: true,
      pauseOnFocusLoss: false,
      draggable: false,
      pauseOnHover: false,
      theme: 'dark',
    };

    render(<Toast options={customOptions} />);
    expect(MockedToastContainer).toHaveBeenCalledTimes(1);
    expect(MockedToastContainer).toHaveBeenCalledWith(
      expect.objectContaining(customOptions), 
      expect.any(Object)
    );
  });
});
