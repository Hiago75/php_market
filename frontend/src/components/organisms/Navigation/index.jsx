import React from "react";

import Icon from "components/atoms/Icon";

import './index.scss';

export default function Navigation() {
  return (
    <div className="Navigation">
      <a href="/">
        <Icon icon="GiTakeMyMoney" className="Navigation-icon" />
        Registrar venda
      </a>

      <a href='/products'>
        <Icon className="Navigation-icon" />
        Produtos
      </a>

      <a href='/categories'>
        <Icon icon="GiHighlighter" className="Navigation-icon" />
        Categorias
      </a>

      <a href="/transactions">
        <Icon icon="AiOutlineUnorderedList" className="Navigation-icon" />
        Transações
      </a>
    </div>
  )
}