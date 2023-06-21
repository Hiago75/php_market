import React from "react";
import { act } from "react-dom/test-utils";
import { fireEvent, render, screen, waitFor } from "@testing-library/react";

import Cart from ".";


describe("Cart", () => {
  let container;

  beforeEach(() => {
    container = document.createElement('div');
    document.body.appendChild(container);

    jest.spyOn(global, 'fetch').mockResolvedValue({
      ok: true,
      json: jest.fn().mockResolvedValue({ data: { id: '123' } }),
    });
  });

  afterEach(() => {
    document.body.removeChild(container);
    container = null;
    jest.restoreAllMocks();
  });

  const setSelectedProducts = jest.fn();
  const baseSelectedProducts = [
    { name: "Phone", category: "Eletrônicos", price: 12, taxesPercentage: 12, quantity: 2 },
    { name: "Leggins", category: "Roupas", price: 8, taxesPercentage: 8, quantity: 3 },
    { name: "Melon", category: "Alimentos", price: 8, taxesPercentage: 5, quantity: 1 },
  ];


  it("should render Cart component with selected products", () => {
    render(
      <Cart
        selectedProducts={baseSelectedProducts}
        setSelectedProducts={jest.fn()}
      />
    );

    const cartElement = screen.getByTestId("cart");
    expect(cartElement).toBeInTheDocument();

    const productLineElements = screen.getAllByTestId("product-line");
    expect(productLineElements.length).toBe(baseSelectedProducts.length);
  });

  it("should handle incrementing product quantity", () => {
    const selectedProducts  = [
      { name: "Phone", category: "Eletrônicos", price: 12, quantity: 2, taxesPercentage: 12 }];
    
    render(
      <Cart selectedProducts={selectedProducts} setSelectedProducts={setSelectedProducts} />
    );

    const incrementButton = screen.getByLabelText("Botão de incremento");
    fireEvent.click(incrementButton);

    const updatedProducts = [
      { name: "Phone", category: "Eletrônicos", price: 12, quantity: 3, taxesPercentage: 12 }];

    expect(setSelectedProducts).toHaveBeenCalledWith(updatedProducts);
  });

  it("should handle decrementing product quantity", () => {

    const selectedProducts = [
      { name: "Phone", category: "Eletrônicos", price: 12, quantity: 2, taxesPercentage: 12 },
    ];

    render(
      <Cart selectedProducts={selectedProducts} setSelectedProducts={setSelectedProducts} />
    );

    const decrementButton = screen.getByLabelText("Botão de decremento");
    fireEvent.click(decrementButton);

    const updatedProducts = [
      { name: "Phone", category: "Eletrônicos", price: 12, quantity: 1, taxesPercentage: 12 },
    ];

    expect(setSelectedProducts).toHaveBeenCalledWith(updatedProducts);
  });

  it("sould register a new sale", async() => {
    jest.spyOn(console, 'log').mockImplementation(() => {});

    render(
      <Cart selectedProducts={baseSelectedProducts} setSelectedProducts={setSelectedProducts} />
    )

    const checkoutButton = screen.getByTestId('button')

    await act(async () => {
      checkoutButton.dispatchEvent(new MouseEvent('click', {bubbles: true}))
    })

    await waitFor(() => {
      expect(fetch).toHaveBeenCalled();
    })
  })
});
