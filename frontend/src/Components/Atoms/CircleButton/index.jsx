import React from "react";
import './index.scss';

export default function CircleButton({children, color}) {
  return <button className="CircleButton" style={{color:color}}>{children}</button>
}