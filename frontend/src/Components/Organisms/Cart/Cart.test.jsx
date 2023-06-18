import React from "react";
import { fireEvent, render, screen } from "@testing-library/react";
import Cart from "./";

describe("Cart", () => {


  it("should render Cart component with selected products", () => {
    const selectedProducts = [
      { name: "Phone", category: "Eletrônicos", price: 12, taxesPercentage: 12, quantity: 2 },
      { name: "Leggins", category: "Roupas", price: 8, taxesPercentage: 8, quantity: 3 },
      { name: "Melon", category: "Alimentos", price: 8, taxesPercentage: 5, quantity: 1 },
    ];

    render(
      <Cart
        selectedProducts={selectedProducts}
        setSelectedProducts={jest.fn()}
      />
    );

    const cartElement = screen.getByTestId("cart");
    expect(cartElement).toBeInTheDocument();

    const productLineElements = screen.getAllByTestId("product-line");
    expect(productLineElements.length).toBe(selectedProducts.length);
  });

  it("should handle incrementing product quantity", () => {
    const selectedProducts  = [
      { name: "Phone", category: "Eletrônicos", price: 12, quantity: 2, taxesPercentage: 12 }];
    const setSelectedProducts = jest.fn();
    
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
    const setSelectedProducts = jest.fn();
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

});
