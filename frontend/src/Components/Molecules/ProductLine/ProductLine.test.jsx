import React from "react";
import { render, fireEvent, screen } from "@testing-library/react";
import ProductLine from "./";

describe("ProductLine", () => {
  it("should render product line with initial counter value", () => {
    const product = { name: "Melon", category: "Eletrônicos", price: "$8" };
    render(<ProductLine product={product} />);
    const counterElement = screen.getByTestId("product-line__counter");

    expect(counterElement).toHaveTextContent("1");
  });

  it("should increment counter when clicking the '+' button", () => {
    const product = { name: "Melon", category: "Eletrônicos", price: "$8" };
    render(<ProductLine product={product} />);
    const incrementButton = screen.getByLabelText("Botão de incremento");
    const counterElement = screen.getByTestId("product-line__counter");

    fireEvent.click(incrementButton);

    expect(counterElement).toHaveTextContent("2");
  });

  it("should decrement counter when clicking the '-' button", () => {
    const product = { name: "Melon", category: "Eletrônicos", price: "$8" };
    render(<ProductLine product={product} />);
    const decrementButton = screen.getByLabelText("Botão de decremento");
    const counterElement = screen.getByTestId("product-line__counter");

    fireEvent.click(decrementButton);

    expect(counterElement).toHaveTextContent("1");
  });

  it("should not decrement counter below 1", () => {
    const product = { name: "Melon", category: "Eletrônicos", price: "$8" };
    render(<ProductLine product={product} />);
    const decrementButton = screen.getByLabelText("Botão de decremento");
    const counterElement = screen.getByTestId("product-line__counter");

    fireEvent.click(decrementButton);
    fireEvent.click(decrementButton);

    expect(counterElement).toHaveTextContent("1");
  });
});
