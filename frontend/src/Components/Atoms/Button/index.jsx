import React from "react";
import './index.scss';

export default function Button({children}) {
  return (
    <button data-testid="button" className="Button">{children}</button>
  )
}