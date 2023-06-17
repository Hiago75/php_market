import React from "react";
import './index.scss';

export default function Product() {
  return(
    <div className="ProductCard">
      <span data-testid="product-icon" className="ProductCard-icon" />
      <p>Product name</p>
    </div>
  )
}