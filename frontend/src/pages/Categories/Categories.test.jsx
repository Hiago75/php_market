import React from "react";
import { render, screen } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import Categories from "./index";

jest.mock("../../hooks/useFetchData", () => ({
  __esModule: true,
  default: () => ({
    data: {
      data: [{ name: "Category 1" }, { name: "Category 2" }],
    },
    loading: false,
  }),
}));

describe("Categories", () => {
  it("renders category lines correctly", () => {
    render(<Categories />);
    const categoryLines = screen.getAllByTestId("line");
    expect(categoryLines).toHaveLength(2);
  });

  it("registers a category and tax successfully", async () => {
    render(<Categories />);
    const nameInput = screen.getByPlaceholderText("Nome");
    const percentageInput = screen.getByPlaceholderText(
      "Porcentagem de impostos"
    );
    const registerButton = screen.getByRole("button", { name: "Registrar" });

    userEvent.type(nameInput, "New Category");
    userEvent.type(percentageInput, "10");
    userEvent.click(registerButton);

    await screen.findByText("Categoria registrado");
  });
});
