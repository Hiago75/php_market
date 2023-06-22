import React from "react";

import "./index.scss";

export default function Line({ children, className }) {
  return (
    <li data-testid="line" className={`Line ${className}`}>
      {children}
    </li>
  );
}
