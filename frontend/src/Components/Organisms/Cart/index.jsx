import React from "react";

import Button from "../../Atoms/Button";
import Price from "../../Atoms/Price";
import CircleButton from "../../Atoms/CircleButton";

import './index.scss'

export default function Cart({ children }) {
  return (
    <aside data-testid="cart" className="Cart">
      <header>
        <h2>Carrinho</h2>
        <CircleButton>X</CircleButton>
      </header>

      <ul>
        {children}
      </ul>

      <footer data-testid="cart-footer">
        <Price label="Sub-total">43</Price>
        <Price label="Impostos">2</Price>
        <br />
        <Price label="Total">45</Price>
        <br />
        <Button>Finalizar compra</Button>
      </footer>
    </aside>
  )
}