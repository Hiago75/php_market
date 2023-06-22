import React from "react";

import "./index.scss";

export default function Line({ children, className, onClick }) {
  return (
    <li data-testid="line" onClick={onClick} className={`Line ${className}`}>
      {children}
    </li>
  );
}
