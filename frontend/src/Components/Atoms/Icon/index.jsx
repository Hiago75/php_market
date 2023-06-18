import * as giIcons from "react-icons/gi";
import { GiShoppingBag } from "react-icons/gi";

export default function Icon({ icon, className }) {
  const getIcon = (iconName) => {
    const iconsMap = new Map();
    iconsMap.set("Gi", giIcons);
    if(!iconName) return;

    return iconsMap.get(iconName.substring(0, 2));
  };

  const icons = getIcon(icon);
  const TheIcon = icons ? icons[icon] : GiShoppingBag;

  return <TheIcon data-testid="icon" className={className} />;
}
