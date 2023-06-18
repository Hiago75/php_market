import React from "react";
import './index.scss';

export default function Price({label, children}) {
  return (
    <div data-testid="price" className="Price">
      <p data-testid="label">{label}</p>
      <span data-testid="price-value">R${children}</span>
    </div>
  )
}