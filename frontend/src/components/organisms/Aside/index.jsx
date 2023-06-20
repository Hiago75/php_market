import React from "react";
import './index.scss';

export default function Aside({className, children}) {
  return (<aside className={`Aside ${className}`}>{children}</aside>)
}