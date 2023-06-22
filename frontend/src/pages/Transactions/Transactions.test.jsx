import React from "react";
import { render, screen } from "@testing-library/react";
import Transactions from "./index";

jest.mock("../../hooks/useFetchData", () => ({
  __esModule: true,
  default: () => ({
    data: {
      data: [
        {
          id: 1,
          sale_date: "2023-06-19T10:30:00Z",
          total: 50.0,
        },
        {
          id: 2,
          sale_date: "2023-06-20T14:45:00Z",
          total: 75.0,
        },
      ],
    },
    loading: false,
  }),
}));

describe("Transactions", () => {
  it("renders transaction lines correctly", () => {
    render(<Transactions />);
    const transactionLines = screen.getAllByTestId("line");
    expect(transactionLines).toHaveLength(2);
  });

  // it("displays correct details in the aside", () => {
  //   render(<Transactions />);
  //   const subtotal = screen.getByText("50.0");
  //   const taxes = screen.getByText("75.0");
  //   const total = screen.getByText("125.0");

  //   expect(subtotal).toBeInTheDocument();
  //   expect(taxes).toBeInTheDocument();
  //   expect(total).toBeInTheDocument();
  // });
});
