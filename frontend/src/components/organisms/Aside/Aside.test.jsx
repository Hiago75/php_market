import React from "react";
import { render, screen } from "@testing-library/react";
import Aside from "./";

describe("Aside", () => {
  it("renders children correctly", () => {
    render(<Aside>Hello World</Aside>);
    const asideElement = screen.getByText("Hello World");
    expect(asideElement).toBeInTheDocument();
  });

  it("applies custom className", () => {
    render(<Aside className="custom">Hello World</Aside>);
    const asideElement = screen.getByText("Hello World");
    expect(asideElement).toHaveClass("custom");
  });
});
