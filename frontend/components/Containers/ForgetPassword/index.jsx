"use client";
import { useForgetPasswordMutation } from "@/store/features/auth/apiSlice";
import { useRouter } from "next/navigation";
import React, { useState } from "react";
import StringLang from "@/utilities/StringLang";

function Index() {
  const [email, setEmail] = useState("");
  const router = useRouter();
  const [forgotPassword, { isLoading, isSuccess, isError, error }] =
    useForgetPasswordMutation();
  if (isSuccess) {
    router.push(`/auth/forget-password/${email}`);
  }

  return (
    <div className="w-full bg-black rounded-[5px] md:px-[60px] md:py-10 p-5">
      <p className="text-[24px] font-semibold text-white leading-8  text-center">
        <StringLang string="Forget Password" />
      </p>
      <p className="text-base leading-[26px] text-center mb-11">
        <StringLang string="No worries, we will send you reset instructions." />
      </p>
      <div className="grid grid-cols-2 gap-[30px] mb-8">
        <div className="col-span-full w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              <span className=" relative z-10">Email*</span>
              <div className="w-full h-0.5 bg-white relative z-0"></div>
            </label>
            <input
              type="text"
              placeholder="Email"
              name="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className={`w-full h-full bg-[#0B0E12] rounded-[5px] border ${
                isError ? "border-red-500" : "border-[#23262B]"
              } px-4 focus:outline-none`}
            />
            {isError ? (
              <p className="pt-2 px-2 text-red-500">{error?.data?.message}</p>
            ) : (
              ""
            )}
          </div>
        </div>
      </div>
      <button
        type="button"
        disabled={isLoading}
        onClick={() => {
          forgotPassword(email);
        }}
        className="w-full h-[62px] rounded bg-primary-blue text-primary-black flex justify-center items-center text-[18px] font-semibold tracking-wider mb-3"
      >
        <StringLang string="Send Code" />
      </button>
    </div>
  );
}

export default Index;
