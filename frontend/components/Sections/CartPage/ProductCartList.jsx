"use client";
import React from "react";
import CartItems from "@/components/Common/Card/CartItems";
import StringLang from "@/utilities/StringLang";

function ProductCartList({ cartItems }) {
  return (
    <div
      style={{ boxShadow: "0px 25px 63px 0px rgba(0, 0, 0, 0.05)" }}
      className="relative w-full overflow-x-auto border border-[#23262B] rounded-[5px]"
    >
      <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded-[5px] overflow-hidden">
        <tbody>
          {/* table heading */}
          <tr className="text-[13px] font-medium text-white bg-[#0B0E12] whitespace-nowrap px-2 border-b border-[#23262B] capitalize">
            <td className="text-lg font-semibold py-4 pl-10 block whitespace-nowrap min-w-[300px] text-white ">
              <StringLang string="Product" />
            </td>
            <td className="text-lg font-semibold py-4 whitespace-nowrap text-center min-w-[200px]  text-white ">
              <StringLang string="Quantity" />
            </td>
            <td className="text-lg font-semibold py-4 whitespace-nowrap  text-center min-w-[200px] text-white ">
              <StringLang string="Price" />
            </td>
            <td className="text-lg font-semibold py-4 whitespace-nowrap  text-center  min-w-[200px] text-white ">
              <StringLang string="Discount" />
            </td>
            <td className="text-lg font-semibold py-4 whitespace-nowrap text-center w-[114px] text-white ">
              <StringLang string="Total" />
            </td>
            <td className="text-lg font-semibold py-4 whitespace-nowrap text-center w-[114px] text-white ">
              <StringLang string="Action" />
            </td>
          </tr>
          {/* table heading end */}
          {cartItems?.map((item) => (
            <CartItems cartData={item} key={item.id} />
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default ProductCartList;
