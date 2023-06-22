import React from "react";
import { render, screen } from "@testing-library/react";
import Line from "./";

describe("Line", () => {
  it("renders children correctly", () => {
    const children = <span>Line content</span>;
    render(<Line>{children}</Line>);
    const lineElement = screen.getByTestId("line");
    expect(lineElement).toBeInTheDocument();
    expect(lineElement).toHaveClass("Line");
    expect(lineElement).toHaveTextContent("Line content");
  });

  it("applies additional className correctly", () => {
    const children = <span>Line content</span>;
    const className = "custom-class";
    render(<Line className={className}>{children}</Line>);
    const lineElement = screen.getByTestId("line");
    expect(lineElement).toHaveClass("Line");
    expect(lineElement).toHaveClass("custom-class");
  });
});
