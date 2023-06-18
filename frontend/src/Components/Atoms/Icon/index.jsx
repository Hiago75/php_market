import * as giIcons from "react-icons/gi";

export default function Icon({ icon, className }) {
  const getIcon = (iconName) => {
    const iconsMap = new Map();
    iconsMap.set("Gi", giIcons);

    return iconsMap.get(iconName.substring(0, 2));
  };

  const icons = getIcon(icon);
  const TheIcon = icons[icon];

  return <TheIcon data-testid="icon" className={className} />;
};
