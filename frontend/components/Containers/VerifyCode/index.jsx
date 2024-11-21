"use client";
import React, { useEffect } from "react";
import StringLang from "@/utilities/StringLang";

function Index({ code, handleInput, handleSubmit, resendOTP, verifying }) {
  return (
    <div className="w-full bg-black rounded-[5px] md:px-[60px] md:py-10 p-5">
      <p className="text-[24px] font-semibold text-white leading-8  text-center">
        <StringLang string="Verification Code" />
      </p>
      <p className="text-base leading-[26px] text-center mb-[55px]">
        <StringLang string="No worries, we will send you reset instructions." />
      </p>
      <div className="flex justify-center mb-[30px]">
        <div
          id="otp-inputs"
          className="flex rtl:space-x-reverse space-x-[14px] notranslate"
        >
          <input
            type="text"
            data-index="one"
            defaultValue={code.one}
            pattern="/^[0-9]*$/"
            onKeyUp={(e) => handleInput(e)}
            maxLength="1"
            className="w-[50px] h-[50px] px-4 py-3 text-white rounded-[5px] text-sm bg-[#0B0E12]  focus:border-primary-blue caret-transparent cursor-pointer border border-[#23262B]  focus:outline-none"
            id="otp"
          />
          <input
            type="text"
            min="0"
            max="9"
            data-index="two"
            pattern="/^[0-9]*$/"
            maxLength="1"
            onKeyUp={(e) => handleInput(e)}
            defaultValue={code.two}
            className="w-[50px] h-[50px] px-4 py-3 text-white rounded-[5px] text-sm bg-[#0B0E12] focus:border-primary-blue caret-transparent cursor-pointer border border-[#23262B]  focus:outline-none"
            id="otp"
          />
          <input
            type="text"
            data-index="three"
            pattern="/^[0-9]*$/"
            maxLength="1"
            onKeyUp={(e) => handleInput(e)}
            defaultValue={code.three}
            className="w-[50px] h-[50px] px-4 py-3 text-white rounded-[5px] text-sm bg-[#0B0E12] focus:border-primary-blue caret-transparent cursor-pointer border border-[#23262B]  focus:outline-none"
            id="otp"
          />
          <input
            type="text"
            pattern="/^[0-9]*$/"
            maxLength="1"
            data-index="four"
            onKeyUp={(e) => handleInput(e)}
            defaultValue={code.four}
            className="w-[50px] h-[50px] px-4 py-3 text-white rounded-[5px] text-sm bg-[#0B0E12] focus:border-primary-blue caret-transparent cursor-pointer border border-[#23262B]  focus:outline-none"
            id="otp"
          />
          <input
            type="text"
            pattern="/^[0-9]*$/"
            maxLength="1"
            data-index="five"
            onKeyUp={(e) => handleInput(e)}
            defaultValue={code.five}
            className="w-[50px] h-[50px] px-4 py-3 text-white rounded-[5px] text-sm bg-[#0B0E12] focus:border-primary-blue caret-transparent cursor-pointer border border-[#23262B]  focus:outline-none"
            id="otp"
          />
          <input
            type="text"
            pattern="/^[0-9]*$/"
            maxLength="1"
            data-index="six"
            onKeyUp={(e) => handleInput(e)}
            defaultValue={code.six}
            className="w-[50px] h-[50px] px-4 py-3 text-white rounded-[5px] text-sm bg-[#0B0E12] focus:border-primary-blue caret-transparent cursor-pointer border border-[#23262B]  focus:outline-none"
            id="otp"
          />
        </div>
      </div>
      <p
        onClick={resendOTP}
        className=" cursor-pointer text-center mb-5 hover:text-primary-blue transition-all duration-300"
      >
        <StringLang string="Resend Again?" />
      </p>
      <button
        type="button"
        disabled={verifying}
        onClick={handleSubmit}
        className="w-full h-[62px] rounded bg-primary-blue text-primary-black flex justify-center items-center text-[18px] font-semibold tracking-wider mb-3"
      >
        <StringLang string="Send Code" />
      </button>
    </div>
  );
}

export default Index;
