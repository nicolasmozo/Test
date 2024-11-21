"use client";
import { useUserRegisterMutation } from "@/store/features/auth/apiSlice";
import React, { useEffect, useState } from "react";
import { useRouter } from "next/navigation";
import StringLang from "@/utilities/StringLang";
const initialState = {
  firstName: "",
  lastName: "",
  email: "",
  userName: ``,
  password: "",
  password_confirmation: "",
  agree: true,
};
function Index() {
  const [userInfo, setUserInfo] = useState(initialState);
  const [error, setError] = useState(false);
  const [userRegister, { data, isLoading, error: errorMessage, isSuccess }] =
    useUserRegisterMutation();
  const router = useRouter();

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
  // submit handler
  const submitHandler = () => {
    if (!error) {
      userRegister({
        ...userInfo,
        userName: `${userInfo.firstName} ${userInfo.lastName}`,
      });
    }
  };
  useEffect(() => {
    if (errorMessage?.data?.errors) {
      setError(errorMessage?.data?.errors);
    }
    if (isSuccess) {
      router.push(`/auth/signup/${userInfo.email}`);
    }
  }, [errorMessage, isSuccess]);
  return (
    <div className="w-full bg-black rounded-[5px] md:px-[60px] md:py-10 p-5">
      <div className="w-full flex justify-center mb-5">
        <div className="flex rtl:space-x-reverse space-x-2.5 items-center "></div>
      </div>
      <p className="text-[24px] font-semibold text-white leading-8 mb-8 text-center">
        <StringLang string="Create User Account" />
      </p>
      <div className="grid sm:grid-cols-2 grid-cols-1 gap-[30px] mb-5">
        <div className="w-full">
          <div className="input-field h-[50px] relative ">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              <span className=" relative z-10">First&nbsp;Name*</span>
              <div className="w-full h-0.5 bg-white relative z-0"></div>
            </label>
            <input
              type="text"
              name="firstName"
              onChange={inputHandler}
              value={userInfo.firstName}
              placeholder="Name"
              className={`w-full h-full bg-[#0B0E12] rounded-[5px] border  ${
                error?.firstName ? " border-red-500/50" : "border-[#23262B]"
              } px-4 focus:outline-none`}
            />
          </div>
          {error?.firstName
            ? error.firstName.map((item) => (
                <p key={item} className="pt-2 px-2 text-red-500">
                  {item}
                </p>
              ))
            : ""}
        </div>
        <div className="w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              <span className=" relative z-10">Last&nbsp;Name*</span>
              <div className="w-full h-0.5 bg-white relative z-0"></div>
            </label>
            <input
              type="text"
              name="lastName"
              onChange={inputHandler}
              value={userInfo.lastName}
              placeholder="Name"
              className={`w-full h-full bg-[#0B0E12] rounded-[5px] border ${
                error?.lastName ? " border-red-500/50" : "border-[#23262B]"
              } px-4 focus:outline-none`}
            />
          </div>
          {error?.lastName
            ? error.lastName.map((item) => (
                <p key={item} className="pt-2 px-2 text-red-500">
                  {item}
                </p>
              ))
            : ""}
        </div>

        <div className="col-span-full w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              <span className=" relative z-10">Email*</span>
              <div className="w-full h-0.5 bg-white relative z-0"></div>
            </label>
            <input
              type="text"
              name="email"
              onChange={inputHandler}
              value={userInfo.email}
              placeholder="Email"
              className={`w-full h-full bg-[#0B0E12] rounded-[5px] border ${
                error?.email ? " border-red-500/50" : "border-[#23262B]"
              } px-4 focus:outline-none`}
            />
          </div>
          {error?.email
            ? error.email.map((item) => (
                <p key={item} className="pt-2 px-2 text-red-500">
                  {item}
                </p>
              ))
            : ""}
        </div>
        <div className=" w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              <span className=" relative z-10">Password*</span>
              <div className="w-full h-0.5 bg-white relative z-0"></div>
            </label>
            <input
              type="password"
              name="password"
              onChange={inputHandler}
              value={userInfo.password}
              placeholder="● ● ● ● ● ●"
              className={`w-full h-full bg-[#0B0E12] rounded-[5px] border text-sm ${
                error?.password ? " border-red-500/50" : "border-[#23262B]"
              } px-4 focus:outline-none`}
            />
          </div>
          {error?.password
            ? error.password.map((item) => (
                <p key={item} className="pt-2 px-2 text-red-500">
                  {item}
                </p>
              ))
            : ""}
        </div>
        <div className=" w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              <span className=" relative z-10">Confirm&nbsp;Password*</span>
              <div className="w-full h-0.5 bg-white relative z-0"></div>
            </label>
            <input
              type="password"
              name="password_confirmation"
              onChange={inputHandler}
              value={userInfo.password_confirmation}
              placeholder="● ● ● ● ● ●"
              className={`w-full h-full bg-[#0B0E12] rounded-[5px] border text-sm ${
                error?.password_confirmation
                  ? " border-red-500/50"
                  : "border-[#23262B]"
              } px-4 focus:outline-none`}
            />
          </div>
          {error?.password_confirmation
            ? error.password_confirmation.map((item) => (
                <p key={item} className="pt-2 px-2 text-red-500">
                  {item}
                </p>
              ))
            : ""}
        </div>
      </div>
      <div className=" mb-[45px]">
        <div className="flex rtl:space-x-reverse space-x-3 items-center">
          <span>
            <input
              type="checkbox"
              name="agree"
              onChange={inputHandler}
              checked={userInfo.agree}
              className="h-5 w-5 rounded border border-primary-blue bg-transparent accent-primary-blue"
            />
          </span>
          <p className="text-base leading-[26px] ">
            <StringLang string="I agree all" />{" "}
            <a href="/terms-conditions" className="text-primary-blue">
              <StringLang string="terms and condition" />
            </a>{" "}
            <StringLang string="in Alasmart" />
          </p>
        </div>
        {error?.agree
          ? error.agree.map((item) => (
              <p key={item} className="pt-2 px-2 text-red-500">
                {item}
              </p>
            ))
          : ""}
      </div>
      <button
        type="button"
        onClick={submitHandler}
        className="w-full h-[62px] rounded bg-primary-blue text-primary-black flex justify-center items-center text-[18px] font-semibold tracking-wider mb-3"
      >
        <StringLang string="Create Account" />
      </button>
      <p className="text-base leading-[26px] text-center">
        <StringLang string="Already have an Account?" />{" "}
        <a href="/auth/signin" className="text-primary-blue">
          <StringLang string="Log In" />
        </a>
      </p>
    </div>
  );
}

export default Index;
