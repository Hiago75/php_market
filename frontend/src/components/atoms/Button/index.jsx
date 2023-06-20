import React from "react";
import './index.scss';

export default function Button({children, onClick, type='button', name='Button'}) {
  return (
    <button data-testid="button" onClick={onClick} className="Button" name={name} type={type}>{children}</button>
  )
}