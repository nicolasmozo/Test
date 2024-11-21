import { useSelector } from "react-redux";

const useCurrency = () => {
  const currency = useSelector((state) => state.defaultSettings.activeCurrency);
  return (price) => {
    const mainPrice = Number(price) * Number(currency.currency_rate);
    if (currency.currency_position === "left") {
      return (
        <span className="notranslate">
          {currency.currency_icon + mainPrice.toFixed(2)}
        </span>
      );
    } else {
      return (
        <span className="notranslate">
          {mainPrice.toFixed(2) + currency.currency_icon}
        </span>
      );
    }
  };
};

export default useCurrency;
