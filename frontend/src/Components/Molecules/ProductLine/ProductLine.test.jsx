import React from "react";
import { render, fireEvent, screen } from "@testing-library/react";
import ProductLine from "./";

describe("ProductLine", () => {
  it("should render product line correctly", () => {
    const product = {
      name: "Phone",
      category: "Eletrônicos",
      price: 12,
      quantity: 2,
    };
    const onIncrement = jest.fn();
    const onDecrement = jest.fn();

    render(
      <ProductLine
        product={product}
        onIncrement={onIncrement}
        onDecrement={onDecrement}
      />
    );

    const titleElement = screen.getByTestId("product-line__title");
    const priceElement = screen.getByTestId("product-line__price");
    const counterElement = screen.getByTestId("product-line__counter");
    const incrementButton = screen.getByLabelText('Botão de incremento');

    expect(titleElement.textContent).toBe("Phone");
    expect(priceElement.textContent).toBe("R$12");
    expect(counterElement.textContent).toBe("2");
    expect(incrementButton).toBeInTheDocument();
  });

  it("should handle incrementing product quantity", () => {
    const product = {
      name: "Phone",
      category: "Eletrônicos",
      price: 12,
      quantity: 2,
    };
    const onIncrement = jest.fn();
    const onDecrement = jest.fn();

    render(
      <ProductLine
        product={product}
        onIncrement={onIncrement}
        onDecrement={onDecrement}
      />
    );

    const incrementButton = screen.getByLabelText('Botão de incremento');
    fireEvent.click(incrementButton);

    expect(onIncrement).toHaveBeenCalledWith(product);
  });

  it("should handle decrementing product quantity", () => {
    const product = {
      name: "Phone",
      category: "Eletrônicos",
      price: 12,
      quantity: 2,
    };
    const onIncrement = jest.fn();
    const onDecrement = jest.fn();

    render(
      <ProductLine
        product={product}
        onIncrement={onIncrement}
        onDecrement={onDecrement}
      />
    );

    const decrementButton = screen.getByLabelText("Botão de decremento");
    fireEvent.click(decrementButton);

    expect(onDecrement).toHaveBeenCalledWith(product);
  });

  it("should disable decrement button when quantity is 1", () => {
    const product = {
      name: "Phone",
      category: "Eletrônicos",
      price: 12,
      quantity: 1,
    };
    const onIncrement = jest.fn();
    const onDecrement = jest.fn();

    render(
      <ProductLine
        product={product}
        onIncrement={onIncrement}
        onDecrement={onDecrement}
      />
    );

    const decrementButton = screen.getByLabelText("Botão de decremento");
    expect(decrementButton).toBeDisabled();
  });
});
