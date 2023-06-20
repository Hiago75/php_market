import React from "react";

import Icon from "components/atoms/Icon";

import './index.scss';

export default function Navigation() {
  return (
    <div className="Navigation">
      <a href="/">
        <Icon icon="GiTakeMyMoney" className="Navigation-icon" />
        Venda
      </a>

      <a href='/products'>
        <Icon className="Navigation-icon" />
        Produtos
      </a>

      <a href='/categories'>
        <Icon icon="GiHighlighter" className="Navigation-icon" />
        Categorias
      </a>
    </div>
  )
}