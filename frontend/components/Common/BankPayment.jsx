"use client";
import StringLang from "@/utilities/StringLang";
import React, { useState } from "react";

function BankPayment({ paymentInfo, submitAction }) {
  const [tnxId, setTnxId] = useState("");
  return (
    <div>
      <div className="w-full border-primary-border-secondary bg-black rounded-[5px]">
        <p className="text-xl font-bold text-white leading-8">
          <StringLang string={"Our bank information"} />
        </p>
        <p
          className="text-xl  text-white leading-8 mb-7 whitespace-pre-wrap"
          dangerouslySetInnerHTML={{ __html: paymentInfo }}
        ></p>
        <div className="grid md:grid-cols-2 grid-cols-1 gap-5 ">
          <div className="col-span-full w-full">
            <p className="text-xl font-bold text-white leading-8 mb-5">
              <StringLang string={"Your transaction information"} />
            </p>
            <div className="input-field h-[120px] relative">
              <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center">
                Bank Details*
              </label>
              <textArea
                name="account_id"
                value={tnxId}
                onChange={(e) => setTnxId(e.target.value)}
                placeholder={paymentInfo}
                className="w-full h-full placeholder:whitespace-pre-wrap text-white p-3.5  rounded-[5px] bg-[#0B0E12] border border-[#23262B]  px-4 focus:outline-none"
              ></textArea>
            </div>
          </div>
          <div className="w-full flex justify-end col-span-2">
            <button
              className="w-fit"
              onClick={() => {
                submitAction(tnxId);
              }}
            >
              <div className=" h-[54px] bg-primary-yellow text-primary-black flex justify-center items-center rounded-[5px] w-full px-5">
                <span className="text-lg font-semibold">Submit</span>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}

export default BankPayment;
