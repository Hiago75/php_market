import React from "react";
import Button from "../../Atoms/Button";
import './index.scss'


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
        Sub Total: $43
        Tax: $2
        Total: $45;
        <Button>Finalizar compra</Button>
      </footer>
    </aside>
  )
}