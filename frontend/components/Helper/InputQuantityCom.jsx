"use client";
import { useState } from "react";
export default function InputQuantityCom({
  incrementQty,
  cartId,
  decrementQty,
  qyt,
}) {
  const [quantity, setQuantity] = useState(qyt);
  const increment = () => {
    setQuantity((prev) => prev + 1);
    incrementQty(cartId);
  };
  const decrement = () => {
    if (quantity > 1) {
      setQuantity((prev) => prev - 1);
      decrementQty(cartId);
    }
  };
  return (
    <div className="w-[120px] h-[40px] px-[26px] py-3.2 flex items-center border bg-[#0B0E12] border-[#202126] rounded">
      <div className="flex justify-between items-center w-full">
        <button
          onClick={decrement}
          type="button"
          className="text-[22px] text-white focus:text-primary-blue"
        >
          -
        </button>
        <span className="text-lg font-semibold text-white">{quantity}</span>
        <button
          onClick={increment}
          type="button"
          className="text-[22px] text-white focus:text-primary-blue"
        >
          +
        </button>
      </div>
    </div>
  );
}
