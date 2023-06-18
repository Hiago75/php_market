import React, { useState } from "react";
import Icon from "../../Atoms/Icon";
import CircleButton from '../../Atoms/CircleButton';

import { productTypeIconMap } from "../../../utils/productTypeIconMap";

import './index.scss';

export default function ProductLine({ product }) {
  const iconName = productTypeIconMap[product.category]
  const [counter, setCounter] = useState(1);

  const handleIncrement = () => {
    setCounter((prevCounter) => prevCounter + 1);
  };

  const handleDecrement = () => {
    if (counter > 1) {
      setCounter((prevCounter) => prevCounter - 1);
    }
  };

  return (
    <li data-testid="product-line" className="ProductLine">
      <div className="ProductLine-description">
        <div className="ProductLine-icon">
          <Icon icon={iconName} className="ProductLine-icon__figure"/>
        </div>
        
        <div className="ProductLine-info">
          <h3 data-testid="product-line__title">{product.name}</h3>
          <p data-testid="product-line__price">{product.price}</p>
        </div>
      </div>

      <div className="ProductLine-commands">
        <CircleButton
        disabled={counter === 1} 
        label="Botão de decremento" 
        onClick={handleDecrement} 
        color="#63a1f0"
        >
          -
        </CircleButton>

        <span data-testid="product-line__counter" className="ProductLine-counter">{counter}</span>
        
        <CircleButton label="Botão de incremento" onClick={handleIncrement} color="#63a1f0" data-testid="increment-button">
          +
        </CircleButton>
      </div>
    </li>
  )
}