import React from "react";
import Icon from "../../Atoms/Icon";
import CircleButton from '../../Atoms/CircleButton';

import './index.scss';


export default function ProductLine() {
  return (
    <li data-testid="product-line" className="ProductLine">
      <div className="ProductLine-description">
        <div className="ProductLine-icon">
          <Icon icon="GiFruitBowl" className="ProductLine-icon__figure"/>
        </div>
        
        <div className="ProductLine-info">
          <h3 data-testid="product-line__title">Melon</h3>
          <p data-testid="product-line__price">$8</p>
        </div>
      </div>

      <div className="ProductLine-commands">
        <CircleButton color="#63a1f0">-</CircleButton>
        <span className="ProductLine-counter">1</span>
        <CircleButton color="#63a1f0">+</CircleButton>
      </div>
    </li>
  )
}