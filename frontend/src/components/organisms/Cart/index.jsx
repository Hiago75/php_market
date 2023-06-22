import React, { useEffect, useState } from "react";
import { toast } from "react-toastify";

import Button from "components/atoms/Button";
import Price from "components/atoms/Price";
import CircleButton from "components/atoms/CircleButton";
import ProductLine from "components/molecules/ProductLine";

import "./index.scss";
import Toast from "components/molecules/Toast/index";
import { makeRequest } from "services/api";

export default function Cart({ selectedProducts, setSelectedProducts }) {
  const [subTotal, setSubTotal] = useState(0);
  const [taxes, setTaxes] = useState(0);
  const [total, setTotal] = useState(0);

  useEffect(() => {
    const calculateTotals = () => {
      const calculatedSubTotal = selectedProducts.reduce(
        (accumulator, product) =>
          accumulator + product.price * product.quantity,
        0
      );

      const calculatedTaxes = selectedProducts.reduce(
        (accumulator, product) => {
          const taxesPercentage = product.tax_percentage || 0;
          const taxesAmount =
            (product.price * taxesPercentage * product.quantity) / 100;
          return accumulator + taxesAmount;
        },
        0
      );

      const calculatedTotal = calculatedSubTotal + calculatedTaxes;

      setSubTotal(calculatedSubTotal.toFixed(2));
      setTaxes(calculatedTaxes.toFixed(2));
      setTotal(calculatedTotal.toFixed(2));
    };

    calculateTotals();
  }, [selectedProducts]);

  const handleIncrementProduct = (product) => {
    const updatedProducts = selectedProducts.map((p) =>
      p === product ? { ...p, quantity: p.quantity + 1 } : p
    );

    setSelectedProducts(updatedProducts);
  };

  const handleDecrementProduct = (product) => {
    const updatedProducts = selectedProducts.map((p) =>
      p === product && p.quantity > 1 ? { ...p, quantity: p.quantity - 1 } : p
    );

    setSelectedProducts(updatedProducts);
  };

  const handleSaleSubmit = async () => {
    const result = await makeRequest(
      "http://localhost:8080/sales",
      "POST",
      {
        products: selectedProducts,
        subTotal,
        taxes,
        total,
      },
      "Venda registrada."
    );

    if (!result) return;

    setSelectedProducts([]);
    setSubTotal(0);
    setTaxes(0);
    setTotal(0);
  };

  return (
    <div data-testid="cart" className="Cart">
      <header>
        <h2>Carrinho</h2>
        <CircleButton>X</CircleButton>
      </header>

      <ul>
        {selectedProducts.map((product) => (
          <ProductLine
            onIncrement={handleIncrementProduct}
            onDecrement={handleDecrementProduct}
            key={product.name}
            product={product}
          />
        ))}
      </ul>

      <footer data-testid="cart-footer">
        <Price label="Sub-total">{subTotal}</Price>
        <Price label="Impostos">{taxes}</Price>
        <br />
        <Price label="Total">{total}</Price>
        <br />
        <Button name="Checkout" onClick={handleSaleSubmit}>
          Finalizar venda
        </Button>
      </footer>
      <Toast />
    </div>
  );
}
