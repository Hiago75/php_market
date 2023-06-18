import React from "react";
import Button from "../../Atoms/Button";
import './index.scss'
import Price from "../../Atoms/Price";


export default function Cart({ children }) {
  return (
    <aside data-testid="cart" className="Cart">
      <header>
        <h2>Carrinho</h2>
        <button>X</button>
      </header>

      <ul>
        {children}
      </ul>

      <footer>
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