import React from "react";
import Icon from "components/atoms/Icon";

import "./index.scss";

export default function Input({
  label,
  icon,
  type,
  placeholder,
  id,
  value,
  onChange,
  max,
}) {
  return (
    <div className="Input">
      <Icon className="Input-icon" icon={icon} />
      <input
        data-testid="input"
        aria-label={label}
        type={type}
        placeholder={placeholder}
        id={id}
        value={value}
        onChange={onChange}
      />
    </div>
  );
}
