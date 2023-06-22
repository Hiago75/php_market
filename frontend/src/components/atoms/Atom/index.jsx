import React from "react";
import "./index.scss";

export default function Title({ children }) {
  return (
    <h1 data-testid="title" className="Title">
      {children}
    </h1>
  );
}
