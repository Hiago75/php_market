import React from "react";
import './index.scss';

export default function CircleButton({children, color, onClick, label, disabled}) {
  return( 
    <button
    disabled={disabled} 
    aria-label={label} 
    onClick={onClick} 
    className="CircleButton" 
    style={{color:color}}>
      {children}
    </button>
    )
}