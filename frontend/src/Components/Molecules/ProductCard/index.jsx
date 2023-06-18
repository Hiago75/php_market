import React from "react";
import Icon from "../../Atoms/Icon";

import {productTypeIconMap} from '..//../../utils/productTypeIconMap';

import './index.scss';

export default function ProductCard({ product, onClick }) {
  const iconName = productTypeIconMap[product.type_name]

  return(
    <div data-testid="product-card" data-product-id={product.id} className="ProductCard" onClick={onClick}>
      <div className="ProductCard-icon">
        <Icon icon={iconName} className="ProductCard-icon__figure" />
      </div>

      <div className="ProductCard-info">
        <p>{ product.name }</p>
        <span>{ product.type_name }</span>
      </div>
    </div>
  )
}