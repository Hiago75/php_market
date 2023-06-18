import React from "react";

import './index.scss';

export default function ProductGrid({children}) {
  return (
    <div data-testid="product-grid" className="ProductGrid">
        {children}
    </div>
  )
}