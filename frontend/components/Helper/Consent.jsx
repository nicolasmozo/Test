"use client";
import React, { useEffect, useState } from "react";
import { setCookie, hasCookie } from "cookies-next";
import { useSelector } from "react-redux";
import Link from "next/link";

function Consent({ data }) {
  const [consent, setConsent] = useState(true);
  const [consentData, setConsentData] = useState(null);
  useEffect(() => {
    if (data) {
      if (!consentData) {
        setConsentData(data);
      }
    }
  }, [consentData, data]);

  useEffect(() => {
    setConsent(hasCookie("localConsent"));
  }, []);

  const acceptCookie = () => {
    setConsent(true);
    setCookie("localConsent", "true", { maxAge: 60 * 60 * 24 * 365 });
    console.log("accepring cookies");
  };
  const closeP = () => {
    setConsent(true);
    console.log("closing");
  };
  const denyCookie = () => {
    setConsent(true);
    setCookie("localConsent", "false", { maxAge: 60 * 60 * 24 * 365 });
    console.log("denying cookie");
  };
  if (consent === true) {
    return null;
  }
  return (
    <>
      {consentData && (
        <div
          className="fixed md:w-[420px] w-full h-[260px] rounded bg-[#21242b] shadow md:left-8 md:bottom-8 left-0 bottom-0 p-7"
          style={{
            boxShadow: "rgb(0 0 0 / 14%) 0px 15px 50px 0px",
            zIndex: "999999999999999999",
          }}
        >
          <div className="w-full h-full flex flex-col justify-between relative">
            <div>
              <h3 className="text-base text-qgray line-clamp-4">
                {consentData.message}
              </h3>
              <Link href="/privacy-policy">
                <span className="text-sm text-primary-blue cursor-pointer">
                  Read More...
                </span>
              </Link>
            </div>
            <div className="flex rtl:space-x-reverse space-x-4  items-center h-[42px]">
              <button
                onClick={() => {
                  acceptCookie();
                }}
                type="button"
                className="w-1/2 h-full rounded text-base font-bold bg-primary-blue text-primary-black antialiased tracking-wide"
              >
                Accept
              </button>
              <button
                onClick={(e) => denyCookie()}
                type="button"
                className="w-1/2 h-full rounded text-base font-bold border border-primary-blue text-primary-blue antialiased tracking-wide"
              >
                Deny
              </button>
            </div>
            <button
              onClick={(e) => {
                closeP();
              }}
              type="button"
              className="text-red-500 absolute -right-16 -top-10"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="1.5"
                stroke="currentColor"
                className="w-6 h-6"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      )}
    </>
  );
}

export default Consent;
