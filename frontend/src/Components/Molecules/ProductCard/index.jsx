import React from "react";
import Icon from "../../Atoms/Icon";

import {productTypeIconMap} from '..//../../utils/productTypeIconMap';

import './index.scss';


export default function ProductCard({ product, onClick }) {
  const iconName = productTypeIconMap[product.category]

  return(
    <div data-testid="product-card" className="ProductCard" onClick={onClick}>
      <div className="ProductCard-icon">
        <Icon icon={iconName} className="ProductCard-icon__figure" />
      </div>

      <div className="ProductCard-info">
        <p>{ product.name }</p>
        <span>{ product.category }</span>
      </div>
    </div>
  )
}