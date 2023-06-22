import React from "react";
import { render, screen } from "@testing-library/react";
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
});
