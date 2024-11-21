"use client";
import React, { useEffect, useState } from "react";
import Link from "next/link";
import { useSearchParams, useRouter, usePathname } from "next/navigation";
import { toast } from "react-toastify";
import { useLazyLogoutQuery } from "@/store/features/auth/apiSlice";
import { useLazyGetCartQuery } from "@/store/features/cart/apiSlice";
import { useSelector } from "react-redux";
import StringLang from "@/utilities/StringLang";
import DropDown from "../Helper/DropDown";
import { useDispatch } from "react-redux";
import { changeCurrency } from "@/store/features/setup/setupSlice";
import { getCookie, hasCookie, setCookie } from "cookies-next";

function AppHeader({ settings, categories, languages, currencies }) {
  const authProfile = useSelector((state) => state.auth.user);
  const router = useRouter();
  const searchParams = useSearchParams();
  const verified = searchParams.get("verified");
  const seller_approval = searchParams.get("seller_approval");
  const message = searchParams.get("message");
  const pathname = usePathname();
  const [logout, { isLoading, isSuccess }] = useLazyLogoutQuery();
  useEffect(() => {
    if (!!verified) {
      router.push("/");
    }
    if (verified === "yes") {
      toast.success(message);
    }
    if (verified === "no") {
      toast.error(message);
    }
  }, [verified]);
  useEffect(() => {
    if (!!seller_approval) {
      router.push("/");
    }
    if (seller_approval === "yes") {
      logout();
      toast.success(message);
    }
    if (seller_approval === "no") {
      toast.error(message);
    }
  }, [seller_approval]);
  const [searchKey, setSearchkey] = useState("");
  const [open, setOpen] = useState(false);
  const [tab, setTab] = useState("category");
  const [categoryToggle, setCategoryToggle] = useState(false);
  useEffect(() => {
    setCategoryToggle(false);
  }, [pathname, searchParams]);
  const auth = useSelector((state) => state.auth.accessToken);
  const [getCartData, { data }] = useLazyGetCartQuery();

  useEffect(() => {
    if (!!auth) {
      getCartData();
    }
  }, [auth]);
  // currency
  const dispatch = useDispatch();
  const changeCurrencyHandler = (value) => {
    dispatch(changeCurrency(value));
  };
  // translate
  const [selectedLanguage, setLanguage] = useState(
    languages && languages.length > 0 ? languages[0] : null
  );
  useEffect(() => {
    let addScript = document.createElement("script");
    addScript.setAttribute(
      "src",
      "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
    );
    document.body.appendChild(addScript);
    window.googleTranslateElementInit = googleTranslateElementInit;
  }, []);

  const googleTranslateElementInit = () => {
    new window.google.translate.TranslateElement(
      {
        pageLanguage: "auto",
        autoDisplay: false,
      },
      "google_translate_element"
    );
  };
  const setCookieHandlerAction = (lang_code) => {
    // Get the current hostname
    const currentDomain = window.location.hostname;
    // Determine if the current domain is a subdomain
    const isSubdomain = currentDomain.split(".").length >= 2;
    const cookieDomain = isSubdomain ? `.${currentDomain}` : currentDomain;
    // Set the cookie
    setCookie("googtrans", `/auto/${lang_code}`, {
      path: "/",
      domain: `${cookieDomain}`, // Use the appropriate domain
      secure: false,
    });
    if (currentDomain !== "localhost") {
      deleteCookie("googtrans", `${currentDomain}`);
      if (currentDomain.split(".").length === 3) {
        const dotDomain = currentDomain.split(".").slice(1, 3).join(".");
        setCookie("googtrans", `/auto/${lang_code}`, {
          path: "/",
          domain: `${dotDomain}`, // Use the appropriate domain
          secure: false,
        });
      }
    }
  };

  useEffect(() => {
    if (languages && languages.length > 0) {
      if (hasCookie("googtrans")) {
        const getCode = getCookie("googtrans").replace("/auto/", "");
        const findItem = languages.find((item) => item.lang_code === getCode);
        setLanguage(findItem);
        if (getCode === "ar" || getCode === "he") {
          document.body.setAttribute("dir", "rtl");
        } else {
          document.body.setAttribute("dir", "ltr");
        }
      } else {
        setLanguage(languages[0]);
        if (
          languages[0].lang_code === "ar" ||
          languages[0].lang_code === "he"
        ) {
          document.body.setAttribute("dir", "rtl");
        } else {
          document.body.setAttribute("dir", "ltr");
        }
      }
    }
  }, [languages]);

  const langChange = (value) => {
    setCookieHandlerAction(value.lang_code);
    setLanguage(value);
    setTimeout(() => {
      window.location.reload();
    }, 2000);
  };
  return (
    <>
      <div className="w-full bg-black lg:block hidden">
        <div className="w-full border-b border-primary-border">
          <div className="theme-container mx-auto h-[80px]">
            <div className="flex justify-between items-center  h-full">
              <div className="flex justify-between max-w-[740px] w-full">
                <div>
                  <Link href="/">
                    <img
                      src={process.env.BASE_URL + settings.logo}
                      alt=""
                      className="max-h-[38px]"
                    />
                  </Link>
                </div>
                <div className="2xl:w-[462px] relative">
                  <input
                    value={searchKey}
                    onChange={(e) => setSearchkey(e.target.value)}
                    placeholder="Search your products..."
                    className="h-[52px] rounded ltr:pl-[22px] ltr:pr-[100px] rtl:pr-[22px] rtl:pl-[100px]  bg-[#0B0E12] border border-[#23262B] focus:outline-0 text-white  w-full placeholder:text-sm"
                    type="text"
                  />
                  <Link href={`/products?search=${searchKey}`}>
                    <div className="w-[90px] h-[42px] rounded flex justify-center items-center bg-primary-yellow group  hover:bg-white hover:text-black  common-transition absolute  top-1.5 right-2 rtl:right-auto rtl:left-2">
                      <span className="text-sm font-semibold text-primary-black  common-transition group-hover:text-black">
                        <StringLang string="Search" />
                      </span>
                    </div>
                  </Link>
                </div>
              </div>
              <div className="flex rtl:space-x-reverse space-x-5 items-center">
                <div>
                  <Link href="/auth/profile/favorites">
                    <span>
                      <svg
                        width="22"
                        height="20"
                        viewBox="0 0 22 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M16 4.50005C17.1045 4.50005 18 5.39548 18 6.50005M11 3.70259L11.6851 3.00005C13.816 0.814763 17.2709 0.814761 19.4018 3.00005C21.4755 5.12665 21.5392 8.55385 19.5461 10.76L13.8197 17.0982C12.2984 18.782 9.70154 18.782 8.18026 17.0982L2.45393 10.76C0.460783 8.55388 0.5245 5.12667 2.5982 3.00007C4.72912 0.814774 8.18404 0.814776 10.315 3.00007L11 3.70259Z"
                          stroke="white"
                          strokeWidth="1.5"
                          strokeLinecap="round"
                          strokeLinejoin="round"
                        />
                      </svg>
                    </span>
                  </Link>
                </div>
                <div>
                  <Link href="/cart">
                    <span className="relative">
                      <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M6 4H18C20.2091 4 22 5.79086 22 8V13C22 15.2091 20.2091 17 18 17H10C7.79086 17 6 15.2091 6 13V4ZM6 4C6 2.89543 5.10457 2 4 2H2"
                          stroke="white"
                          strokeWidth="1.5"
                          strokeLinecap="round"
                          strokeLinejoin="round"
                        />
                        <path
                          d="M11 20.5C11 21.3284 10.3284 22 9.5 22C8.67157 22 8 21.3284 8 20.5C8 19.6716 8.67157 19 9.5 19C10.3284 19 11 19.6716 11 20.5Z"
                          stroke="white"
                          strokeWidth="1.5"
                        />
                        <path
                          d="M20 20.5C20 21.3284 19.3284 22 18.5 22C17.6716 22 17 21.3284 17 20.5C17 19.6716 17.6716 19 18.5 19C19.3284 19 20 19.6716 20 20.5Z"
                          stroke="white"
                          strokeWidth="1.5"
                        />
                        <path
                          d="M11 12C13.3561 13.3404 14.6476 13.3263 17 12"
                          stroke="white"
                          strokeWidth="1.5"
                          strokeLinecap="round"
                          strokeLinejoin="round"
                        />
                      </svg>

                      <span className="absolute left-[13px] -top-[6px] w-[13px] h-[13px] flex justify-center items-center text-black bg-[#FFB321] rounded-full text-[8px]">
                        {data?.items?.length || 0}
                      </span>
                    </span>
                  </Link>
                </div>
                {authProfile ? (
                  <a href="/auth/profile">
                    <div className="w-10 h-10 rounded-full overflow-hidden border-2 border-primary-blue">
                      <img
                        src={process.env.BASE_URL + authProfile.image}
                        alt=""
                        className="w-full h-full object-cover"
                      />
                    </div>
                  </a>
                ) : (
                  <div>
                    <a
                      href="/auth/signin"
                      className="w-8 h-8 flex justify-center items-center"
                    >
                      <svg
                        width="28"
                        height="28"
                        viewBox="0 0 28 28"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <ellipse
                          cx="14"
                          cy="20.4167"
                          rx="8.16667"
                          ry="4.08333"
                          stroke="white"
                          strokeWidth="1.5"
                          strokeLinejoin="round"
                        />
                        <circle
                          cx="14"
                          cy="8.16667"
                          r="4.66667"
                          stroke="white"
                          strokeWidth="1.5"
                          strokeLinejoin="round"
                        />
                      </svg>
                    </a>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
        <div className="theme-container mx-auto h-[67px]">
          <div className="w-full flex justify-between items-center h-full">
            <div className=" flex gap-[70px] items-center">
              <div className="w-[270px] h-full flex items-center relative">
                <button
                  onClick={() => setCategoryToggle(!categoryToggle)}
                  type="button"
                  className="flex justify-between py-3 px-[18px] h-fit bg-[#23262B]  w-full items-center rounded-md  "
                >
                  <div className="flex rtl:space-x-reverse space-x-3 items-center">
                    <span>
                      <svg
                        width="14"
                        height="9"
                        viewBox="0 0 14 9"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <rect width="14" height="1" fill="white" />
                        <rect y="8" width="14" height="1" fill="white" />
                        <rect y="4" width="10" height="1" fill="white" />
                      </svg>
                    </span>
                    <span className="text-sm font-semibold text-white tracking-wider">
                      <StringLang string="All Categories" />
                    </span>
                  </div>
                  <div>
                    <svg
                      width="9"
                      height="5"
                      viewBox="0 0 9 5"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <rect
                        x="8.18359"
                        y="0.910156"
                        width="5.78538"
                        height="1.28564"
                        transform="rotate(135 8.18359 0.910156)"
                        fill="white"
                      />
                      <rect
                        x="4.08984"
                        y="5"
                        width="5.78538"
                        height="1.28564"
                        transform="rotate(-135 4.08984 5)"
                        fill="white"
                      />
                    </svg>
                  </div>
                </button>
                {categoryToggle && (
                  <div
                    style={{
                      boxShadow: "rgba(0, 0, 0, 0.14) 0px 15px 50px 0px",
                    }}
                    data-aos="fade-up"
                    className="w-full absolute left-0 top-full bg-black z-20"
                  >
                    {categories && categories.length > 0 ? (
                      <ul className="categories-list relative">
                        {categories.map((item, i) => (
                          <li
                            key={i}
                            className="category-item transition-all duration-300 ease-in-out"
                          >
                            <Link href={`/products?category=${item.slug}`}>
                              <div className=" flex justify-between items-center px-5 h-10 cursor-pointer  hover:bg-[#0b0e12] text-white">
                                <div className="flex items-center rtl:space-x-reverse space-x-6">
                                  <span className="icon">
                                    <img
                                      src={process.env.BASE_URL + item.icon}
                                      alt=""
                                      className="w-6 h-6 object-contain"
                                    />
                                  </span>
                                  <span className="">{item.name}</span>
                                </div>
                                <div>
                                  <span className="icon-arrow">
                                    <svg
                                      width="6"
                                      height="9"
                                      viewBox="0 0 6 9"
                                      fill="none"
                                      xmlns="http://www.w3.org/2000/svg"
                                      className="fill-current rtl:rotate-180"
                                    >
                                      <rect
                                        x="1.49805"
                                        y="0.818359"
                                        width="5.78538"
                                        height="1.28564"
                                        transform="rotate(45 1.49805 0.818359)"
                                      />
                                      <rect
                                        x="5.58984"
                                        y="4.90918"
                                        width="5.78538"
                                        height="1.28564"
                                        transform="rotate(135 5.58984 4.90918)"
                                      />
                                    </svg>
                                  </span>
                                </div>
                              </div>
                            </Link>
                          </li>
                        ))}
                      </ul>
                    ) : (
                      <div className="w-full flex justify-center items-center mt-5">
                        <span className="text-sm text-primary-black">
                          <StringLang string="No Category Found" />
                        </span>
                      </div>
                    )}
                  </div>
                )}
              </div>
              <nav>
                <ul className="flex rtl:space-x-reverse space-x-[50px] items-center">
                  <li>
                    <Link
                      href="/products"
                      className="text-base font-medium text-white "
                    >
                      <StringLang string="Shops" />
                    </Link>
                  </li>
                  <li>
                    <Link
                      href="/blogs"
                      className="text-base font-medium text-white "
                    >
                      <StringLang string="Blogs" />
                    </Link>
                  </li>
                  <li>
                    <Link
                      href="/about"
                      className="text-base font-medium text-white "
                    >
                      <StringLang string="About" />
                    </Link>
                  </li>
                  <li>
                    <Link
                      href="/contact"
                      className="text-base font-medium text-white "
                    >
                      <StringLang string="Contact" />
                    </Link>
                  </li>
                </ul>
              </nav>
            </div>
            <Link href="/auth/become-seller">
              <div className="lg:px-5 lg:py-2.5 px-1.5 py-1 rounded-[5px] bg-primary-yellow group  hover:bg-white hover:text-black  common-transition">
                <span className="text-base font-semibold text-primary-black  common-transition group-hover:text-black">
                  <StringLang string="Become a Seller" />
                </span>
              </div>
            </Link>
          </div>
        </div>
      </div>
      <div className="lg:hidden block w-full bg-black  px-5 py-2 mb-2">
        <div className="flex flex-col space-y-3.5">
          <div className="w-full h-full flex justify-between items-center">
            <div className="w-[150px] h-full flex justify-start items-center relative">
              <Link href="/">
                <img src={process.env.BASE_URL + settings.logo} alt="" />
              </Link>
            </div>
            <div className="flex rtl:space-x-reverse space-x-5 items-center">
              <div>
                <Link href="/auth/profile/favorites">
                  <span>
                    <svg
                      width="22"
                      height="20"
                      viewBox="0 0 22 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M16 4.50005C17.1045 4.50005 18 5.39548 18 6.50005M11 3.70259L11.6851 3.00005C13.816 0.814763 17.2709 0.814761 19.4018 3.00005C21.4755 5.12665 21.5392 8.55385 19.5461 10.76L13.8197 17.0982C12.2984 18.782 9.70154 18.782 8.18026 17.0982L2.45393 10.76C0.460783 8.55388 0.5245 5.12667 2.5982 3.00007C4.72912 0.814774 8.18404 0.814776 10.315 3.00007L11 3.70259Z"
                        stroke="white"
                        strokeWidth="1.5"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                      />
                    </svg>
                  </span>
                </Link>
              </div>
              <div>
                <Link href="/cart">
                  <span className="relative">
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M6 4H18C20.2091 4 22 5.79086 22 8V13C22 15.2091 20.2091 17 18 17H10C7.79086 17 6 15.2091 6 13V4ZM6 4C6 2.89543 5.10457 2 4 2H2"
                        stroke="white"
                        strokeWidth="1.5"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                      />
                      <path
                        d="M11 20.5C11 21.3284 10.3284 22 9.5 22C8.67157 22 8 21.3284 8 20.5C8 19.6716 8.67157 19 9.5 19C10.3284 19 11 19.6716 11 20.5Z"
                        stroke="white"
                        strokeWidth="1.5"
                      />
                      <path
                        d="M20 20.5C20 21.3284 19.3284 22 18.5 22C17.6716 22 17 21.3284 17 20.5C17 19.6716 17.6716 19 18.5 19C19.3284 19 20 19.6716 20 20.5Z"
                        stroke="white"
                        strokeWidth="1.5"
                      />
                      <path
                        d="M11 12C13.3561 13.3404 14.6476 13.3263 17 12"
                        stroke="white"
                        strokeWidth="1.5"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                      />
                    </svg>

                    <span className="absolute left-[13px] -top-[6px] w-[13px] h-[13px] flex justify-center items-center text-black bg-[#FFB321] rounded-full text-[8px]">
                      {data?.items?.length || 0}
                    </span>
                  </span>
                </Link>
              </div>
              <div>
                <a
                  href="/auth/profile"
                  className="w-8 h-8 flex justify-center items-center"
                >
                  <svg
                    width="28"
                    height="28"
                    viewBox="0 0 28 28"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <ellipse
                      cx="14"
                      cy="20.4167"
                      rx="8.16667"
                      ry="4.08333"
                      stroke="white"
                      strokeWidth="1.5"
                      strokeLinejoin="round"
                    />
                    <circle
                      cx="14"
                      cy="8.16667"
                      r="4.66667"
                      stroke="white"
                      strokeWidth="1.5"
                      strokeLinejoin="round"
                    />
                  </svg>
                </a>
              </div>
            </div>
          </div>
          <div className="w-full flex rtl:space-x-reverse space-x-5 items-center">
            <div className="w-[44px] h-[44px] flex justify-center items-center rounded-lg bg-[#0B0E12] border border-[#23262B]">
              <div onClick={() => setOpen(true)}>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  className="h-6 w-6 text-primary-blue"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  strokeWidth="2"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M4 6h16M4 12h16M4 18h7"
                  />
                </svg>
              </div>
            </div>
            <div className="flex-1 relative">
              <input
                value={searchKey}
                onChange={(e) => setSearchkey(e.target.value)}
                placeholder="Search your products..."
                className="h-[44px] rounded ltr:pl-[22px] ltr:pr-[100px] rtl:pr-[22px] rtl:pl-[100px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 text-white w-full placeholder:text-sm"
                type="text"
              />
              <Link href={`/products?search=${searchKey}`}>
                <div className="w-[90px] h-[32px] rounded flex justify-center items-center bg-primary-yellow group  hover:bg-white hover:text-black  common-transition absolute ltr:right-2 ltr:left-auto rtl:left-2 rtl:right-auto top-1.5">
                  <span className="text-sm font-semibold text-primary-black  common-transition group-hover:text-black">
                    <StringLang string="Search" />
                  </span>
                </div>
              </Link>
            </div>
          </div>
        </div>
      </div>
      <div
        className={`drawer-wrapper w-full lg:hidden block  h-full relative `}
      >
        {open && (
          <div
            onClick={() => setOpen(!open)}
            className="w-full h-screen bg-primary-black bg-opacity-40 z-40 left-0 top-0 fixed"
          ></div>
        )}
        <div
          className={`w-[280px] transition-all duration-300 ease-in-out h-screen overflow-y-auto overflow-x-hidden overflow-style-none bg-black fixed top-0 z-50 ${
            open ? "left-0" : "-left-[280px]"
          }`}
        >
          <div className="w-full px-5 mt-5 mb-4">
            <div className="flex justify-between items-center mb-5">
              <Link href="/">
                <img src={process.env.BASE_URL + settings.logo} alt="" />
              </Link>
              <button onClick={() => setOpen(!open)} type="button">
                <svg
                  width="34"
                  height="34"
                  viewBox="0 0 34 34"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M17.0363 33.9994C7.66923 34.031 0.0436412 26.4423 0.000545718 17.0452C-0.0425497 7.68436 7.54917 0.0479251 16.9447 0.00021656C26.3072 -0.0467224 33.9505 7.54277 33.9998 16.9352C34.0483 26.3153 26.4411 33.9679 17.0363 33.9994Z"
                    fill="#232532"
                  />
                  <path
                    d="M17.0363 33.9994C26.4411 33.9679 34.0483 26.3153 33.9998 16.9352C33.9505 7.54277 26.3072 -0.0467224 16.9447 0.00021656C7.54917 0.0479251 -0.0425497 7.68436 0.000545718 17.0452C0.0436412 26.4423 7.66846 34.031 17.0363 33.9994ZM23.4629 21.5945C23.4514 21.8445 23.3321 22.0908 23.1305 22.3039C22.7865 22.6671 22.4479 23.0342 22.1039 23.3966C21.5236 24.0084 21.1458 24.0068 20.5648 23.3889C19.4581 22.2124 18.3492 21.0389 17.2533 19.8523C17.0633 19.6461 16.9686 19.6169 16.7608 19.8431C15.6511 21.0512 14.5222 22.2424 13.3978 23.4366C12.8753 23.9914 12.4697 23.9891 11.9388 23.4312C11.6032 23.0788 11.2715 22.7218 10.9399 22.3647C10.4089 21.7938 10.4081 21.3575 10.9376 20.7927C12.0503 19.6046 13.1593 18.4126 14.2836 17.2361C14.4822 17.0283 14.5037 16.9152 14.2921 16.6943C13.1654 15.5193 12.058 14.3266 10.9452 13.1385C10.4004 12.556 10.4042 12.1259 10.9545 11.5387C11.2785 11.1925 11.6009 10.8447 11.9272 10.5007C12.4821 9.91666 12.8822 9.92358 13.4417 10.5192C14.5468 11.6965 15.6588 12.8677 16.7516 14.0573C16.9671 14.2912 17.071 14.2651 17.271 14.0473C18.3831 12.8415 19.5082 11.6472 20.6363 10.4561C21.1273 9.93743 21.5521 9.94359 22.0469 10.4576C22.3848 10.8085 22.7157 11.1655 23.0474 11.5226C23.6115 12.1289 23.6122 12.5552 23.052 13.1539C21.9477 14.3328 20.8503 15.517 19.7321 16.6828C19.5058 16.9183 19.5382 17.0391 19.7475 17.2584C20.8641 18.4249 21.9623 19.6092 23.0681 20.7865C23.2721 21.002 23.456 21.229 23.4629 21.5945Z"
                    fill="#FE4949"
                  />
                  <path
                    d="M23.4614 21.5947C23.4545 21.2292 23.2706 21.0022 23.0659 20.7844C21.9608 19.6071 20.8619 18.4228 19.7452 17.2563C19.5359 17.0377 19.5036 16.9169 19.7298 16.6807C20.848 15.5157 21.9454 14.3307 23.0497 13.1518C23.61 12.5539 23.6084 12.1276 23.0451 11.5205C22.7134 11.1635 22.3825 10.8064 22.0447 10.4555C21.5498 9.9415 21.125 9.93611 20.6341 10.454C19.5059 11.6452 18.3808 12.8394 17.2688 14.0452C17.0679 14.263 16.964 14.2891 16.7493 14.0552C15.6565 12.8663 14.5445 11.6952 13.4394 10.5171C12.88 9.92149 12.4798 9.91456 11.9249 10.4986C11.5979 10.8426 11.2762 11.1904 10.9522 11.5367C10.402 12.1238 10.3981 12.5547 10.943 13.1364C12.0558 14.3245 13.1632 15.5172 14.2898 16.6922C14.5014 16.9131 14.4799 17.0254 14.2813 17.234C13.157 18.4113 12.0481 19.6025 10.9353 20.7906C10.4058 21.3561 10.4074 21.7917 10.9376 22.3626C11.2693 22.7197 11.601 23.076 11.9365 23.4291C12.4675 23.987 12.873 23.9893 13.3956 23.4345C14.5207 22.2403 15.6488 21.0491 16.7586 19.841C16.9671 19.614 17.061 19.644 17.2511 19.8502C18.3469 21.0368 19.4559 22.2103 20.5625 23.3868C21.1435 24.0047 21.5214 24.0063 22.1016 23.3945C22.4456 23.0321 22.7842 22.6643 23.1282 22.3018C23.3306 22.091 23.4507 21.8448 23.4614 21.5947Z"
                    fill="white"
                  />
                </svg>
              </button>
            </div>
          </div>
          <div className="w-full mt-5 px-5">
            <div className="search-bar w-full h-[34px] rounded overflow-hidden  flex ">
              <div className="flex-1  h-full bg-[#0B0E12] border border-[#23262B]">
                <input
                  value={searchKey}
                  onChange={(e) => setSearchkey(e.target.value)}
                  placeholder="Search your products..."
                  className="h-full text-sm p-1.5 bg-transparent focus:outline-0 text-white w-full placeholder:text-sm"
                  type="text"
                />
              </div>
              <Link
                href={`/products?search=${searchKey}`}
                className="cursor-pointer w-[40px] h-full bg-primary-blue flex justify-center items-center"
              >
                <span className="text-primary-black">
                  <svg
                    width="23"
                    height="23"
                    viewBox="0 0 23 23"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    className="fill-current"
                  >
                    <path d="M0 8.83158C0.0484783 8.43809 0.0969566 8.04461 0.169674 7.67571C0.484783 5.92962 1.2362 4.42946 2.39968 3.12604C3.75707 1.60128 5.45381 0.592971 7.44142 0.199486C9.76838 -0.267779 11.9741 0.0765214 14.0345 1.33076C16.3614 2.75714 17.84 4.82294 18.3975 7.50356C18.8823 9.7907 18.5187 11.9795 17.4037 14.0453C17.1856 14.4388 17.1856 14.4388 17.5007 14.7585C19.1247 16.4062 20.7487 18.0539 22.3727 19.7016C22.906 20.2427 23.1242 20.8575 22.9302 21.5953C22.5667 22.9971 20.8457 23.5135 19.7549 22.3822C18.8338 21.4231 17.9127 20.5132 16.9674 19.5541C16.216 18.7917 15.4888 18.0539 14.7374 17.2915C14.6889 17.2423 14.6404 17.1932 14.6162 17.1686C14.0345 17.4637 13.5012 17.808 12.9195 18.0539C10.4228 19.1114 7.90196 19.0868 5.42957 17.9555C3.56316 17.0948 2.15728 15.7422 1.16348 13.9469C0.533261 12.791 0.145435 11.5614 0.0484783 10.2334C0.0484783 10.1596 0.0242392 10.0858 0 10.012C0 9.64314 0 9.22507 0 8.83158ZM3.00566 9.4464C3.00566 12.9632 5.84164 15.816 9.30784 15.816C12.774 15.7914 15.5615 12.9632 15.5858 9.4464C15.5858 5.95422 12.7498 3.07685 9.30784 3.07685C5.8174 3.07685 3.00566 5.92962 3.00566 9.4464Z" />
                  </svg>
                </span>
              </Link>
            </div>
          </div>
          <div className="w-full mt-5 px-5 flex items-center rtl:space-x-reverse space-x-3">
            <span
              onClick={() => setTab("category")}
              className={`text-base font-semibold  ${
                tab === "category" ? "text-primary-blue" : "text-white"
              }`}
            >
              <StringLang string="Categories" />
            </span>
            <span className="w-[1px] h-[14px] bg-[#23262B]"></span>
            <span
              onClick={() => setTab("menu")}
              className={`text-base font-semibold ${
                tab === "menu" ? "text-primary-blue" : "text-white"
              }`}
            >
              <StringLang string="Main Menu" />
            </span>
          </div>
          {tab === "category" ? (
            <div className="category-item mt-5 w-full">
              {categories && categories.length > 0 ? (
                <ul className="categories-list">
                  {categories.map((item, i) => (
                    <li key={i} className="category-item">
                      <Link href={`/products?category=${item.slug}`}>
                        <div className=" flex justify-between items-center px-5 h-12   transition-all duration-300 ease-in-out cursor-pointer">
                          <div className="flex items-center rtl:space-x-reverse space-x-6">
                            <span>
                              <img
                                src={process.env.BASE_URL + item.icon}
                                alt=""
                                className="w-6 h-6 object-contain"
                              />
                            </span>
                            <span className="text-sm font-400 capitalize ">
                              {item.name}
                            </span>
                          </div>
                          <div>
                            <span>
                              <svg
                                width="6"
                                height="9"
                                viewBox="0 0 6 9"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <rect
                                  x="1.49805"
                                  y="0.818359"
                                  width="5.78538"
                                  height="1.28564"
                                  transform="rotate(45 1.49805 0.818359)"
                                  fill="#1D1D1D"
                                />
                                <rect
                                  x="5.58984"
                                  y="4.90918"
                                  width="5.78538"
                                  height="1.28564"
                                  transform="rotate(135 5.58984 4.90918)"
                                  fill="#1D1D1D"
                                />
                              </svg>
                            </span>
                          </div>
                        </div>
                      </Link>
                    </li>
                  ))}
                </ul>
              ) : (
                <div className="w-full flex justify-center items-center mt-5">
                  <span className="text-sm text-primary-black">
                    <StringLang string="No Category Found" />
                  </span>
                </div>
              )}
            </div>
          ) : (
            <div className="menu-item mt-5 w-full">
              <ul className="categories-list">
                <li className="category-item">
                  <Link href="/products">
                    <div className=" flex justify-between items-center px-5 h-12  transition-all duration-300 ease-in-out cursor-pointer">
                      <div className="flex items-center rtl:space-x-reverse space-x-6">
                        <span className="text-sm font-400 capitalize ">
                          <StringLang string="Shops" />
                        </span>
                      </div>
                      <div>
                        <span>
                          <svg
                            width="6"
                            height="9"
                            viewBox="0 0 6 9"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <rect
                              x="1.49805"
                              y="0.818359"
                              width="5.78538"
                              height="1.28564"
                              transform="rotate(45 1.49805 0.818359)"
                              fill="#1D1D1D"
                            />
                            <rect
                              x="5.58984"
                              y="4.90918"
                              width="5.78538"
                              height="1.28564"
                              transform="rotate(135 5.58984 4.90918)"
                              fill="#1D1D1D"
                            />
                          </svg>
                        </span>
                      </div>
                    </div>
                  </Link>
                </li>
                <li className="category-item">
                  <Link href="/about">
                    <div className="flex justify-between items-center px-5 h-12  transition-all duration-300 ease-in-out cursor-pointer">
                      <div className="flex items-center rtl:space-x-reverse space-x-6">
                        <span className="text-sm font-400 capitalize ">
                          <StringLang string="about" />
                        </span>
                      </div>
                      <div>
                        <span>
                          <svg
                            width="6"
                            height="9"
                            viewBox="0 0 6 9"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <rect
                              x="1.49805"
                              y="0.818359"
                              width="5.78538"
                              height="1.28564"
                              transform="rotate(45 1.49805 0.818359)"
                              fill="#1D1D1D"
                            />
                            <rect
                              x="5.58984"
                              y="4.90918"
                              width="5.78538"
                              height="1.28564"
                              transform="rotate(135 5.58984 4.90918)"
                              fill="#1D1D1D"
                            />
                          </svg>
                        </span>
                      </div>
                    </div>
                  </Link>
                </li>
                <li className="category-item">
                  <Link href="/contact">
                    <div className="flex justify-between items-center px-5 h-12  transition-all duration-300 ease-in-out cursor-pointer">
                      <div className="flex items-center rtl:space-x-reverse space-x-6">
                        <span className="text-sm font-400 capitalize ">
                          <StringLang string="contact" />
                        </span>
                      </div>
                      <div>
                        <span>
                          <svg
                            width="6"
                            height="9"
                            viewBox="0 0 6 9"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <rect
                              x="1.49805"
                              y="0.818359"
                              width="5.78538"
                              height="1.28564"
                              transform="rotate(45 1.49805 0.818359)"
                              fill="#1D1D1D"
                            />
                            <rect
                              x="5.58984"
                              y="4.90918"
                              width="5.78538"
                              height="1.28564"
                              transform="rotate(135 5.58984 4.90918)"
                              fill="#1D1D1D"
                            />
                          </svg>
                        </span>
                      </div>
                    </div>
                  </Link>
                </li>
                <li className="category-item">
                  <Link href="/blogs">
                    <div className="flex justify-between items-center px-5 h-12  transition-all duration-300 ease-in-out cursor-pointer">
                      <div className="flex items-center rtl:space-x-reverse space-x-6">
                        <span className="text-sm font-400 capitalize ">
                          <StringLang string="blogs" />
                        </span>
                      </div>
                      <div>
                        <span>
                          <svg
                            width="6"
                            height="9"
                            viewBox="0 0 6 9"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <rect
                              x="1.49805"
                              y="0.818359"
                              width="5.78538"
                              height="1.28564"
                              transform="rotate(45 1.49805 0.818359)"
                              fill="#1D1D1D"
                            />
                            <rect
                              x="5.58984"
                              y="4.90918"
                              width="5.78538"
                              height="1.28564"
                              transform="rotate(135 5.58984 4.90918)"
                              fill="#1D1D1D"
                            />
                          </svg>
                        </span>
                      </div>
                    </div>
                  </Link>
                </li>
              </ul>
            </div>
          )}
          <div className="flex space-x-7 rtl:space-x-reverse px-5 mt-5 mb-4">
            <div className="rtl:space-x-reverse space-x-9 items-center flex notranslate ">
              <DropDown
                width={150}
                action={changeCurrencyHandler}
                datas={
                  currencies && currencies.length > 0
                    ? currencies
                        .map((currency) => ({
                          ...currency,
                          name: currency.currency_name,
                        }))
                        .sort(
                          (aDefault, bDefault) => aDefault !== bDefault && 1
                        )
                    : []
                }
              >
                {({ item }) => (
                  <div className="flex rtl:space-x-reverse space-x-[6px] items-center">
                    <span className="text-base text-white font-medium">
                      {item.name}
                    </span>
                    <span>
                      <svg
                        width="9"
                        height="6"
                        viewBox="0 0 9 6"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <rect
                          x="9.00391"
                          y="1"
                          width="6.36242"
                          height="1.41387"
                          transform="rotate(135 9.00391 1)"
                          fill="white"
                        />
                        <rect
                          x="4.5"
                          y="5.5"
                          width="6.36242"
                          height="1.41387"
                          transform="rotate(-135 4.5 5.5)"
                          fill="white"
                        />
                      </svg>
                    </span>
                  </div>
                )}
              </DropDown>
            </div>
            <div className="rtl:space-x-reverse space-x-9 items-center flex notranslate">
              <DropDown
                width={150}
                action={langChange}
                datas={
                  languages && languages.length > 0
                    ? languages.map((item) => ({
                        ...item,
                        name: item.lang_name,
                      }))
                    : []
                }
                position="right"
              >
                {({ item }) => (
                  <div className="flex rtl:space-x-reverse space-x-[6px] items-center">
                    <span className="text-base text-white font-medium">
                      {selectedLanguage
                        ? selectedLanguage.lang_name
                        : item.name}
                    </span>
                    <span>
                      <svg
                        width="9"
                        height="6"
                        viewBox="0 0 9 6"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <rect
                          x="9.00391"
                          y="1"
                          width="6.36242"
                          height="1.41387"
                          transform="rotate(135 9.00391 1)"
                          fill="white"
                        />
                        <rect
                          x="4.5"
                          y="5.5"
                          width="6.36242"
                          height="1.41387"
                          transform="rotate(-135 4.5 5.5)"
                          fill="white"
                        />
                      </svg>
                    </span>
                  </div>
                )}
              </DropDown>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

export default AppHeader;
