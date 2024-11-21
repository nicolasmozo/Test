"use client";
import { useUpdatePasswordMutation } from "@/store/features/auth/apiSlice";
import React, { useState } from "react";
import StringLang from "@/utilities/StringLang";
const initialState = {
  current_password: "",
  password: "",
  password_confirmation: "",
};
function SecurityTab() {
  const [passwords, setPasswords] = useState(initialState);
  const [updatePassword, { isLoading }] = useUpdatePasswordMutation();
  const [isError, setIsError] = useState(false);
  const handleInput = (e) => {
    setPasswords((prev) => ({
      ...prev,
      [e.target.getAttribute("name")]: e.target.value,
    }));
  };
  handleInput.bind(this);
  const handleSubmit = () => {
    setIsError(false);
    if (passwords.password !== passwords.password_confirmation) {
      setIsError("Password and Confirm password is not same.");
    } else {
      updatePassword({
        passwords,
        resetForms: () => setPasswords(initialState),
      });
    }
  };
  return (
    <div className="w-full">
      <div className="w-full">
        <div className="w-full bg-black rounded-[5px] md:px-[60px] md:py-10 p-5">
          <p className="text-[24px] font-bold text-white leading-8  text-center">
            <StringLang string="Set New Password" />
          </p>
          <p className="text-base leading-[26px] text-center mb-11">
            <StringLang string="Welcome back! Login with your data you entered during registration." />
          </p>
          <div className="grid grid-cols-2 gap-[40px] mb-[70px]">
            <div className="col-span-full w-full">
              <div className="input-field h-[50px] relative">
                <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px]  inline-block px-[5px]">
                  Current Password*
                </label>
                <input
                  type="text"
                  placeholder="● ● ● ● ● ●"
                  name="current_password"
                  value={passwords.current_password}
                  onChange={handleInput}
                  className={`w-full h-full rounded-[5px] bg-[#0B0E12] text-white border border-[#23262B] px-4 focus:outline-none`}
                />
              </div>
            </div>
            <div className="col-span-full w-full">
              <div className="input-field h-[50px] relative">
                <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px]  inline-block px-[5px]">
                  <span className=" relative z-10">New&nbsp;Password*</span>
                </label>
                <input
                  type="text"
                  name="password"
                  value={passwords.password}
                  onChange={handleInput}
                  placeholder="● ● ● ● ● ●"
                  className={`w-full h-full bg-[#0B0E12] text-white   rounded-[5px] border ${
                    isError ? " border-red-500/50" : "border-[#23262B]"
                  } px-4 focus:outline-none`}
                />
              </div>
            </div>
            <div className="col-span-full w-full">
              <div className="input-field h-[50px] relative">
                <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px]  inline-block px-[5px]">
                  <span className=" relative z-10">Confirm&nbsp;Password*</span>
                </label>
                <input
                  type="text"
                  name="password_confirmation"
                  value={passwords.password_confirmation}
                  onChange={handleInput}
                  placeholder="● ● ● ● ● ●"
                  className={`w-full h-full bg-[#0B0E12] text-white   rounded-[5px] border ${
                    isError ? " border-red-500/50" : "border-[#23262B]"
                  } px-4 focus:outline-none`}
                />
              </div>
              {isError ? (
                <p className="pt-2 px-2 text-red-500">{isError}</p>
              ) : (
                ""
              )}
            </div>
          </div>
          <button
            type="button"
            disabled={isLoading}
            onClick={() => handleSubmit()}
            className="w-full h-[62px] rounded bg-primary-blue text-primary-black flex justify-center items-center text-[18px] font-semibold tracking-wider mb-3"
          >
            <StringLang string="Update" />
          </button>
        </div>
      </div>
    </div>
  );
}

export default SecurityTab;
