"use client";
import InputQuantityCom from "@/components/Helper/InputQuantityCom";
import useCurrency from "@/hooks/useCurrency";
import {
  useDeleteCartMutation,
  useUpdateQtyMutation,
} from "@/store/features/cart/apiSlice";
import React, { useEffect, useState } from "react";
import Link from "next/link";

function CartItems({ cartData }) {
  const [qty, setQty] = useState(Number(cartData?.qty));
  const [deleteToCart, { isLoading }] = useDeleteCartMutation();
  const [updateQty, { isError }] = useUpdateQtyMutation();
  const currency = useCurrency();

  useEffect(() => {
    const timeoutId = setTimeout(() => {
      if (cartData.qty != qty && qty) {
        updateQty({ productId: cartData.id, qty });
      }
    }, 1000);

    return () => clearTimeout(timeoutId);
  }, [qty]);

  useEffect(() => {
    if (isError) {
      setQty(cartData?.qty);
    }
  }, [isError]);

  return (
    <tr className="bg-black border-b border-[#23262B]">
      <td className="pl-10  py-4  w-[380px]">
        <div className="flex rtl:space-x-reverse space-x-6 items-center">
          <div className="w-[132px] h-[104px] overflow-hidden flex justify-center items-center rounded-md relative">
            <img
              src={process.env.BASE_URL + cartData?.variant_image}
              alt="product"
              className="w-full h-full object-cover"
            />
          </div>
          <div className="flex-1 flex flex-col">
            <div className="mb-2">
              <p className="font-medium text-[22px] text-white notranslate">
                {cartData?.variant_name}
              </p>
            </div>
          </div>
        </div>
      </td>
      <td className=" py-4">
        <div className="flex justify-center items-center">
          <InputQuantityCom
            decrementQty={() => setQty((prev) => (prev > 1 ? prev - 1 : prev))}
            incrementQty={() => setQty((prev) => prev + 1)}
            cartId={cartData.id}
            qyt={qty}
          />
        </div>
      </td>
      <td className="text-center py-4 px-2">
        <div className="flex rtl:space-x-reverse space-x-1 items-center justify-center">
          <span className="text-base text-white font-semibold">
            {currency(Number(cartData?.option_price))}
          </span>
        </div>
      </td>
      <td className="text-center py-4 px-2">
        <div className="flex rtl:space-x-reverse space-x-1 items-center justify-center">
          <span className="text-base font-semibold  text-primary-blue ">
            -{currency(cartData?.discount || 0)}
          </span>
        </div>
      </td>
      <td className="text-right py-4">
        <div className="flex rtl:space-x-reverse space-x-1 items-center justify-center">
          <span className="text-base font-semibold text-white">
            {currency(
              Number(cartData?.option_price) * qty -
                (Number(cartData?.discount) || 0)
            )}
          </span>
        </div>
      </td>
      <td className="text-right py-4 w-[114px]">
        <div className="flex rtl:space-x-reverse space-x-1 items-center justify-center">
          <span
            onClick={() => {
              deleteToCart({ product: cartData });
            }}
            className="cursor-pointer"
          >
            <svg
              width="10"
              height="10"
              viewBox="0 0 10 10"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              className="fill-current text-[#F40C29]"
            >
              <path d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z" />
            </svg>
          </span>
        </div>
      </td>
    </tr>
  );
}

export default CartItems;
