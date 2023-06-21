import React from "react";

import Icon from "components/atoms/Icon";

import './index.scss';

export default function Navigation() {
  const links = [
    { path: "/", icon: "GiShoppingCart", text: "Registrar venda" },
    { path: "/products", icon: 'GiShoppingBag', text: "Produtos" },
    { path: "/categories", icon: "GiHighlighter", text: "Categorias" },
    { path: "/transactions", icon: "AiOutlineUnorderedList", text: "Transações" },
  ];

  
  return (
    <div className="Navigation">
      {links.map((link, index) => (
        <a
          key={index}
          href={link.path}
          className={window.location.pathname === link.path ? "active" : ""}
        >
          {link.icon && (
            <Icon icon={link.icon} className="Navigation-icon" />
          )}
          {link.text}
        </a>
      ))}
    </div>
  )
}