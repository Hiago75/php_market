import React from "react";
import './index.scss';

export default function Button({children, type='button', name='Button'}) {
  return (
    <button data-testid="button" className="Button" name={name} type={type}>{children}</button>
  )
}