"use client";
import { useLoginMutation } from "@/store/features/auth/apiSlice";
import Link from "next/link";
import { useRouter } from "next/navigation";
import React, { useState } from "react";
import StringLang from "@/utilities/StringLang";
const initialState = {
  email: "",
  password: "",
  rememberMe: false,
};
function Index() {
  const [userInfo, setUserInfo] = useState(initialState);
  const router = useRouter();
  const [login, { isLoading, isSuccess, isError, error }] = useLoginMutation();
  // all input handler
  const inputHandler = (e) => {
    // for text input
    if (
      e.target.getAttribute("type") === "text" ||
      e.target.getAttribute("type") === "password"
    ) {
      setUserInfo((prev) => ({
        ...prev,
        [e.target.getAttribute("name")]: e.target.value,
      }));
    } else if (e.target.getAttribute("type") === "checkbox") {
      setUserInfo((prev) => ({
        ...prev,
        [e.target.getAttribute("name")]:
          !userInfo[e.target.getAttribute("name")],
      }));
    }
  };
  inputHandler.bind(this);
  if (isSuccess && !isError && !isLoading) {
    router.back();
  }

  return (
    <div className="w-full bg-black rounded-[5px] md:px-[60px] md:py-10 p-5">
      <p className="text-[24px] font-semibold text-white leading-8  text-center">
        <StringLang string="Sign In" />
      </p>
      <p className="text-base leading-[26px] text-center mb-11">
        <StringLang string="Welcome back! Login with your data you entered during registration." />
      </p>
      <div className="grid grid-cols-2 gap-[30px] mb-5">
        <div className="col-span-full w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm bg-black text-white bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  ltr:right-auto -top-[9px]  inline-block px-[5px]">
              Email*
            </label>
            <input
              type="text"
              name="email"
              value={userInfo.email}
              onChange={inputHandler}
              placeholder="Email"
              className="w-full h-full text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B]  px-4 focus:outline-none"
            />
          </div>
        </div>
        <div className="col-span-full w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm bg-black text-white bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  ltr:right-auto -top-[9px]  inline-block px-[5px]">
              Password*
            </label>
            <input
              type="password"
              name="password"
              value={userInfo.password}
              onChange={inputHandler}
              placeholder="● ● ● ● ● ●"
              className="w-full h-full text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B]  px-4 focus:outline-none text-sm"
            />
          </div>
        </div>
      </div>
      <div className="flex justify-between items-center mb-[45px]   ">
        <div className="flex rtl:space-x-reverse space-x-3 items-center ">
          <span>
            <input
              type="checkbox"
              name="rememberMe"
              onChange={inputHandler}
              checked={userInfo.rememberMe}
              className="h-5 w-5 rounded border border-primary-blue bg-transparent accent-primary-blue"
            />
          </span>
          <p className="text-base leading-[26px] ">
            <StringLang string="Remember Me" />
          </p>
        </div>
        <Link
          href="/auth/forget-password"
          className="text-base text-primary-blue"
        >
          <StringLang string="Forget Password?" />
        </Link>
      </div>
      <button
        type="button"
        disabled={isLoading}
        onClick={() => login(userInfo)}
        className="w-full h-[62px] rounded bg-primary-blue text-primary-black flex justify-center items-center text-[18px] font-semibold tracking-wider mb-3"
      >
        <StringLang string="Sign In" />
      </button>
      <p className="text-base leading-[26px] text-center">
        <StringLang string="Do not have an account?" />{" "}
        <Link href="/auth/signup" className="text-primary-blue">
          <StringLang string="Create Account" />
        </Link>
      </p>
    </div>
  );
}

export default Index;
