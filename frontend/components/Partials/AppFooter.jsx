"use client";
import React, { useState } from "react";
import { useSendEmailMutation } from "@/store/features/subscribe/apiSlice";
import SvgLoader from "@/components/Helper/Loader/SvgLoader";
import { useSelector } from "react-redux";
import Link from "next/link";
import StringLang from "@/utilities/StringLang";

function AppFooter() {
  const footerData = useSelector((state) => state.defaultSettings);
  const { settings } = footerData;
  const appUrl = typeof window !== "undefined" ? window.location.origin : "";
  const [email, setEmail] = useState("");
  const [sendEmail, { isLoading }] = useSendEmailMutation();
  const doSubscribe = () => {
    let data = {
      email: email,
      redirect_url: appUrl,
    };
    sendEmail({ data, handler: setEmail });
  };
  return (
    <div className="w-full pt-[60px] bg-black">
      <div className="theme-container mx-auto">
        <div className="w-full bg-[#0B0E13] border-[#23262B] border rounded-lg lg:flex justify-between items-center xl:p-10 p-7">
          <p className="lg:text-[35px] lg:leading-[42px] text-2xl text-white font-bold mb-2 lg:mb-0">
            <StringLang string="Subscribe Newsletter" />
          </p>
          <div className="sm:flex sm:rtl:space-x-reverse space-x-5 items-center">
            <input
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Email Address"
              type="text"
              className="sm:w-[350px] w-full h-[56px] bg-black border border-[#0B0E12] rounded p-6 focus:outline-none"
            />
            <button onClick={doSubscribe} type="button">
              <div className="lg:py-4 lg:px-10 py-3 px-5 flex rtl:space-x-reverse space-x-2.5 items-center bg-primary-blue group  hover:bg-white hover:text-black text-primary-black  common-transition rounded-[5px] mt-2 sm:mt-0">
                <div className="flex rtl:space-x-reverse space-x-2 items-center">
                  <span className="text-primary-black  common-transition group-hover:text-black text-base font-medium leading-5">
                    <StringLang string="Subscribe" />
                  </span>
                  <span>
                    {isLoading && <SvgLoader className="text-balck" />}
                  </span>
                </div>

                <span>
                  <svg
                    width="21"
                    height="14"
                    viewBox="0 0 21 14"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    className="rtl:rotate-180"
                  >
                    <path
                      d="M17.6701 6.19402C17.5805 6.19402 17.4968 6.19402 17.4072 6.19402C11.9868 6.19402 6.56652 6.19402 1.14621 6.19402C1.00278 6.19402 0.859353 6.18894 0.721903 6.21941C0.273696 6.30574 -0.0430371 6.69167 0.00477159 7.07253C0.0585564 7.48894 0.423098 7.78855 0.901186 7.81394C0.996803 7.81902 1.09242 7.81902 1.19401 7.81902C6.5964 7.81902 12.0048 7.81902 17.4072 7.81902C17.4968 7.81902 17.5805 7.81902 17.7299 7.81902C17.6343 7.90535 17.5805 7.95613 17.5207 8.00691C15.9311 9.36277 14.3354 10.7186 12.7458 12.0745C12.3514 12.4096 12.3096 12.8718 12.6442 13.2069C12.9789 13.5471 13.5586 13.5979 13.9709 13.3237C14.0366 13.2831 14.0904 13.2323 14.1502 13.1815C16.3076 11.3483 18.4649 9.51004 20.6163 7.67175C21.1362 7.22996 21.1362 6.78816 20.6163 6.34636C18.447 4.49793 16.2717 2.64949 14.1024 0.795971C13.8155 0.552222 13.4928 0.435425 13.0924 0.531909C12.4351 0.689331 12.1841 1.3698 12.6084 1.81668C12.6621 1.87761 12.7279 1.92839 12.7936 1.98425C14.3713 3.32488 15.943 4.67058 17.5267 6.01121C17.5864 6.06199 17.6641 6.08738 17.7299 6.128C17.706 6.14324 17.688 6.16863 17.6701 6.19402Z"
                      fill="currentColor"
                    ></path>
                  </svg>
                </span>
              </div>
            </button>
          </div>
        </div>
        <div className="w-full mt-10 flex xl:flex-row flex-col xl:gap-[128px]  gap-10  pb-[30px]">
          <div className="xl:w-[301px]">
            <div className="mb-9">
              <Link href="/">
                <img
                  src={process.env.BASE_URL + settings?.setting?.logo}
                  alt=""
                  className="max-h-[38px]"
                />
              </Link>
            </div>
            <p
              dangerouslySetInnerHTML={{
                __html: settings?.footer?.description.replace(/<[^>]*>/g, ""),
              }}
              className="text-base text-[#E5E7EB]"
            ></p>
          </div>
          <div className="flex-1">
            <div className="grid md:grid-cols-3 grid-cols-2 lg:gap-0 gap-10 justify-between">
              <div>
                <p className="text-lg text-white leading-8 mb-[14px]">
                  <StringLang string="Company" />
                </p>
                <ul>
                  <li>
                    <Link
                      href="/about"
                      className="text-base hover:text-primary-blue common-transition leading-[34px]"
                    >
                      <StringLang string="About Us" />
                    </Link>
                  </li>
                  <li>
                    <Link
                      href="/products"
                      className="text-base hover:text-primary-blue common-transition leading-[34px]"
                    >
                      <StringLang string="Products" />
                    </Link>
                  </li>
                  <li>
                    <Link
                      href="/contact"
                      className="text-base hover:text-primary-blue common-transition leading-[34px]"
                    >
                      <StringLang string="Contact us" />
                    </Link>
                  </li>
                  <li>
                    <Link
                      href="/blogs"
                      className="text-base hover:text-primary-blue common-transition leading-[34px]"
                    >
                      <StringLang string="Blogs" />
                    </Link>
                  </li>
                  <li>
                    <Link
                      href="/faq"
                      className="text-base hover:text-primary-blue common-transition leading-[34px]"
                    >
                      <StringLang string="FAQ" />
                    </Link>
                  </li>
                </ul>
              </div>
              <div>
                <p className="text-lg text-white leading-8 mb-[14px]">
                  <StringLang string="Categories" />
                </p>
                <ul>
                  {footerData?.settings.categories.length > 0 &&
                    footerData?.settings.categories
                      .slice(
                        0,
                        footerData?.settings.categories.length >= 5
                          ? 5
                          : footerData?.settings.categories.length
                      )
                      .map((category, i) => (
                        <li key={i}>
                          <Link
                            href={`/products?category=${category.slug}`}
                            className="text-base hover:text-primary-blue common-transition leading-[34px]"
                          >
                            {category.name}
                          </Link>
                        </li>
                      ))}
                </ul>
              </div>
              <div>
                <p className="text-lg text-white leading-8 mb-[14px]">
                  <StringLang string="Social" />
                </p>
                <ul>
                  {footerData?.settings.social_links?.length > 0 &&
                    footerData?.settings.social_links?.map((link, i) => (
                      <li key={i}>
                        <Link
                          href={link.link}
                          target="_blank"
                          className="text-base hover:text-primary-blue common-transition leading-[34px]"
                        >
                          {link.text}
                        </Link>
                      </li>
                    ))}
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div className="border-t border-[#1A1A1A] w-full sm:h-[50px] h-[70px] flex sm:flex-row flex-col-reverse sm:justify-between justify-center items-center ">
          <div>
            <p className="text-base leading-7 text-white font-semibold ">
              {settings?.footer?.copyright}
            </p>
          </div>
          <div className="flex lg:rtl:space-x-reverse space-x-7 rtl:space-x-reverse space-x-2 items-center">
            <Link
              href="/privacy-policy"
              className="text-base hover:text-primary-blue text-white common-transition"
            >
              <StringLang string="Privacy Policy" />
            </Link>
            <span className="text-base ">|</span>
            <Link
              href="/terms-conditions"
              className="text-base hover:text-primary-blue text-white common-transition"
            >
              {" "}
              <StringLang string="Terms & Conditions" />
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}

export default AppFooter;
