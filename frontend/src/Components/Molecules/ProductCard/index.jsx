import React from "react";
import './index.scss';

export default function ProductCard({ product }) {
  return(
    <div data-testid="product-card" className="ProductCard">
      <span data-testid="product-icon" className="ProductCard-icon" />

      <div className="ProductCard-info">
        <p>{ product.name }</p>
        <span>{ product.category }</span>
      </div>
    </div>
  )
}