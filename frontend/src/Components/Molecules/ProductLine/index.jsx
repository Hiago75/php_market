import React from "react";
import './index.scss';

export default function ProductLine() {
  return (
    <li data-testid="product-line" className="ProductLine">
      <h3 data-testid="product-line__title">Melon</h3>
      <p data-testid="product-line__price">$8</p>
    </li>
  )
}