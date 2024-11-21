"use client";
import React from "react";
import ProductCartList from "@/components/Sections/CartPage/ProductCartList";
import { useGetCartQuery } from "@/store/features/cart/apiSlice";
import isAuth from "@/Middleware/isAuth";
import useCurrency from "@/hooks/useCurrency";
import MiniSvgLoader from "@/components/Helper/Loader/SvgLoader";
import Link from "next/link";
import StringLang from "@/utilities/StringLang";
import EmptyCart from "@/components/Ui/EmptyCart";

function Index() {
  const { data, isFetching } = useGetCartQuery();
  const currency = useCurrency();
  if (!data && isFetching) {
    return (
      <div className="w-full flex items-start py-[60px] min-h-screen justify-center">
        <MiniSvgLoader />
      </div>
    );
  }
  if (data && data.items && data.items.length > 0) {
    return (
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="w-full mb-[30px]">
            <ProductCartList cartItems={data?.items} />
          </div>
          <div className="w-full">
            <div className="w-full sm:flex sm:rtl:space-x-reverse space-x-5  lg:justify-end"></div>
          </div>
          <div className="w-full mt-[30px] flex sm:justify-end">
            <div className="sm:w-[370px] w-full border border-[#23262B] px-[30px] py-[26px] rounded-[5px]">
              <div className="total mb-6">
                <div className=" flex justify-between">
                  <p className="text-[18px] font-medium text-white">
                    <StringLang string="Total" />
                  </p>
                  <p className="text-[18px] font-medium text-white">
                    ${" "}
                    {data?.items?.reduce((total, item) => {
                      return (
                        Number(item.option_price) * Number(item.qty) + total
                      );
                    }, 0) -
                      data?.items?.reduce((total, item) => {
                        return Number(item?.discount || 0) + total;
                      }, 0)}
                  </p>
                </div>
              </div>
              <Link href="/checkout">
                <div className="w-full h-[54px] bg-[#FFB321] text-black flex justify-center items-center rounded-[5px]">
                  <span className="text-lg font-semibold">
                    <StringLang string="Proceed to Checkout" />
                  </span>
                </div>
              </Link>
            </div>
          </div>
        </div>
      </div>
    );
  }
  if (data && data.items && data.items.length === 0) {
    return (
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <EmptyCart />
        </div>
      </div>
    );
  }
}

export default isAuth(Index);
