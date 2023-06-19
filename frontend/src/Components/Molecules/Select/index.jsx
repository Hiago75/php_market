import React from 'react';
import Icon from '../../Atoms/Icon';

import './index.scss';

export default function Select({ options, value, onChange, icon, label }) {
  return (
    <div className="Select">
      <Icon className="Select-icon" icon={icon} />
      <select data-testid="select" value={value} onChange={onChange}>
        <option value="">{label}</option>
        {options.map((option) => (
          <option key={option.id} value={option.id}>
            {option.name}
          </option>
        ))}
      </select>
    </div>
  );
}
