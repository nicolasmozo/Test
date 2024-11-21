"use client";
import { useResetPasswordMutation } from "@/store/features/auth/apiSlice";
import { useParams, useRouter, useSearchParams } from "next/navigation";
import React, { useState } from "react";
import StringLang from "@/utilities/StringLang";

function Index() {
  const { email } = useParams();
  const searchParams = useSearchParams();
  const router = useRouter();
  const [isPassSame, setIsPassSame] = useState(true);
  const [resetPassword, { isLoading, isError, error, isSuccess }] =
    useResetPasswordMutation();
  const code = searchParams.get("code");
  const [password, setPassword] = useState({
    password: "",
    password_confirmation: "",
  });
  const handleInput = (e) => {
    setPassword((prev) => ({
      ...prev,
      [e.target.getAttribute("name")]: e.target.value,
    }));
  };
  handleInput.bind(this);
  const handleSubmit = () => {
    if (password.password === password.password_confirmation) {
      resetPassword({
        email: email.replace("%40", "@"),
        code: code,
        ...password,
      });
    } else {
      setIsPassSame(false);
    }
  };
  if (isSuccess) {
    router.push("/auth/signin");
  }
  return (
    <>
      <div className="w-full bg-black rounded-[5px] md:px-[60px] md:py-10 p-5">
        <p className="text-[24px] font-semibold text-white leading-8  text-center">
          <StringLang string="New Password" />
        </p>
        <p className="text-base leading-[26px] text-center mb-11">
          <StringLang string="No worries, we will send you reset instructions." />
        </p>
        <div className="grid grid-cols-2 gap-[30px] mb-5">
          <div className="col-span-full w-full">
            <div className="input-field h-[50px] relative">
              <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30  inline-block px-[5px]">
                New Password*
              </label>
              <input
                type="password"
                name="password"
                value={password.password}
                onChange={handleInput}
                placeholder="● ● ● ● ● ●"
                className="w-full  h-[50px] text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
              />
            </div>
          </div>
          <div className="col-span-full w-full">
            <div className="input-field h-[50px] relative">
              <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30  inline-block px-[5px]">
                Confirm Password*
              </label>
              <input
                type="password"
                name="password_confirmation"
                value={password.password_confirmation}
                onChange={handleInput}
                placeholder="● ● ● ● ● ●"
                className="w-full  h-[50px] text-white  rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
              />
            </div>
          </div>
        </div>
        {!isPassSame ? (
          <p className="pb-2 px-2 text-red-500">
            Password and confirm password doesn't match
          </p>
        ) : (
          ""
        )}
        {isError ? (
          <p className="pb-2 px-2 text-red-500">{error?.data?.message}</p>
        ) : (
          ""
        )}
        <button
          type="button"
          onClick={handleSubmit}
          disabled={isLoading}
          className="w-full h-[62px] rounded bg-primary-blue text-primary-black flex justify-center items-center text-[18px] font-semibold tracking-wider mb-3"
        >
          <StringLang string="Send Code" />
        </button>
      </div>
    </>
  );
}

export default Index;
