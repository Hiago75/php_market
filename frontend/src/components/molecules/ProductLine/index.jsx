import React, { useState } from "react";

import Icon from "components/atoms/Icon";
import CircleButton from "components/atoms/CircleButton";
import { productTypeIconMap } from "utils/productTypeIconMap";

import "./index.scss";

export default function ProductLine({
  product,
  onIncrement,
  onDecrement,
  onRemove,
}) {
  const iconName = productTypeIconMap[product.type_name];
  const [counter, setCounter] = useState(product.quantity);

  const handleIncrement = () => {
    setCounter((prevCounter) => prevCounter + 1);
    onIncrement(product);
  };

  const handleDecrement = () => {
    if (counter > 1) {
      setCounter((prevCounter) => prevCounter - 1);
      onDecrement(product);
    }
  };

  return (
    <li
      data-testid="product-line"
      data-product-id={product.id}
      className="ProductLine"
    >
      <div className="ProductLine-description">
        <div className="ProductLine-icon">
          <Icon icon={iconName} className="ProductLine-icon__figure" />
          <h3 data-testid="product-line__title">{product.name}</h3>
        </div>

        <div className="ProductLine-info">
          <p data-testid="product-line__price">R${product.price}</p>
        </div>
      </div>

      <div className="ProductLine-commands">
        <div>
          <CircleButton
            disabled={counter === 1}
            label="Botão de decremento"
            onClick={handleDecrement}
            color="#63a1f0"
          >
            -
          </CircleButton>

          <span
            data-testid="product-line__counter"
            className="ProductLine-counter"
          >
            {counter}
          </span>

          <CircleButton
            label="Botão de incremento"
            onClick={handleIncrement}
            color="#63a1f0"
            data-testid="increment-button"
          >
            +
          </CircleButton>
        </div>

        <CircleButton onClick={onRemove}>X</CircleButton>
      </div>
    </li>
  );
}
