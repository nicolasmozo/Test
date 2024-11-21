"use client";
import isAuth from "@/Middleware/isAuth";
import PageTitleArea from "@/components/Common/PageTitleArea";
import Modal from "@/components/Helper/Modal";
import { useLazyLogoutQuery } from "@/store/features/auth/apiSlice";
import Link from "next/link";
import { usePathname, useRouter } from "next/navigation";
import React, { useState } from "react";
import useLanguage from "@/hooks/useLanguage";

function Layout({ children }) {
  const [selectedTab, setSelectedTab] = useState("profile");
  const router = useRouter();
  const [logout, { isLoading, isSuccess }] = useLazyLogoutQuery();
  const path = usePathname();
  const lastPath = path.split("/").pop();
  if (isSuccess) {
    router.push("/");
  }
  const [toggleModal, setToggleModal] = useState(false);
  const language = useLanguage();
  return (
    <>
      {toggleModal && (
        <Modal onClose={() => setToggleModal(false)}>
          <div className="w-full h-screen fixed left-0 top-0  flex justify-center items-center z-50">
            <div
              onClick={() => setToggleModal(false)}
              className="w-full h-full fixed left-0 top-0 bg-primary-black bg-opacity-50"
            ></div>
            <div className=" bg-black z-50 py-10 px-[109px] flex justify-center items-center transform transition duration-300 ease-in-out scale-100 rounded">
              <div>
                <div className="flex justify-center mb-9">
                  <span className="text-[#cf222e] w-[174px] aspect-square rounded-full overflow-hidden bg-[#EB5757]/10 flex justify-center items-center">
                    <svg
                      width="92"
                      height="92"
                      viewBox="0 0 92 92"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <g clip-path="url(#clip0_7683_10492)">
                        <path
                          d="M89.1188 43.1268H52.703C51.1161 43.1268 49.8281 41.8388 49.8281 40.2519C49.8281 38.6649 51.1161 37.377 52.703 37.377H89.1188C90.7058 37.377 91.9937 38.6649 91.9937 40.2519C91.9937 41.8388 90.7058 43.1268 89.1188 43.1268Z"
                          fill="#FE3030"
                        />
                        <path
                          d="M74.7492 57.5009C74.0129 57.5009 73.2774 57.2208 72.7173 56.6579C71.5942 55.5342 71.5942 53.7135 72.7173 52.5905L85.0606 40.2479L72.7173 27.9046C71.5942 26.7816 71.5942 24.9609 72.7173 23.8379C73.841 22.7142 75.6617 22.7142 76.7847 23.8379L91.1592 38.2125C92.2822 39.3355 92.2822 41.1561 91.1592 42.2792L76.7847 56.6537C76.2211 57.2208 75.4855 57.5009 74.7492 57.5009Z"
                          fill="#FE3030"
                        />
                        <path
                          d="M30.6659 92C29.8454 92 29.0671 91.8849 28.2894 91.6435L5.2206 83.9579C2.08178 82.8615 0 79.9368 0 76.6674V7.66959C0 3.44145 3.43852 0.00292969 7.66666 0.00292969C8.48646 0.00292969 9.26485 0.118038 10.0432 0.359486L33.1113 8.0451C36.2508 9.14144 38.3319 12.0662 38.3319 15.3355V84.3334C38.3319 88.5615 34.8941 92 30.6659 92ZM7.66666 5.75275C6.61243 5.75275 5.74982 6.61536 5.74982 7.66959V76.6674C5.74982 77.4837 6.29799 78.2425 7.07989 78.5148L30.0406 86.166C30.2055 86.2193 30.4203 86.2502 30.6659 86.2502C31.7202 86.2502 32.5821 85.3876 32.5821 84.3334V15.3355C32.5821 14.5193 32.0339 13.7605 31.252 13.4882L8.29134 5.83698C8.12639 5.78363 7.91162 5.75275 7.66666 5.75275Z"
                          fill="#FE3030"
                        />
                        <path
                          d="M58.4614 30.6689C56.8744 30.6689 55.5865 29.3809 55.5865 27.794V10.5445C55.5865 7.90332 53.4366 5.75275 50.7954 5.75275H7.67179C6.08483 5.75275 4.79688 4.4648 4.79688 2.87784C4.79688 1.29088 6.08483 0.00292969 7.67179 0.00292969H50.7954C56.6105 0.00292969 61.3363 4.72941 61.3363 10.5445V27.794C61.3363 29.3809 60.0484 30.6689 58.4614 30.6689Z"
                          fill="#FE3030"
                        />
                        <path
                          d="M50.7864 80.4999H35.453C33.8661 80.4999 32.5781 79.212 32.5781 77.625C32.5781 76.0381 33.8661 74.7501 35.453 74.7501H50.7864C53.4275 74.7501 55.5774 72.5995 55.5774 69.9584V52.7089C55.5774 51.1219 56.8654 49.834 58.4523 49.834C60.0393 49.834 61.3272 51.1219 61.3272 52.7089V69.9584C61.3272 75.7735 56.6015 80.4999 50.7864 80.4999Z"
                          fill="#FE3030"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_7683_10492">
                          <rect width="92" height="92" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </span>
                </div>
                <div className="flex justify-center mb-7">
                  <div>
                    <h2 className=" text-4xl font-semibold text-white mb-4 text-center">
                      Are you sure want <br /> to Logout ?
                    </h2>
                  </div>
                </div>

                <div className="flex justify-center">
                  <div className="flex rtl:space-x-reverse space-x-5 items-center">
                    <button
                      onClick={() => setToggleModal(false)}
                      type="button"
                      className="text-white text-base font-semibold capitalize w-[180px] h-[53px] rounded-md border border-white"
                    >
                      cancel
                    </button>
                    <button
                      type="button"
                      onClick={() => logout()}
                      className="text-white text-base font-semibold capitalize w-[180px] h-[53px] rounded-md  tracking-wide  bg-[#FE3030] transition duration-300 ease-in-out"
                    >
                      Yes, Logout
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Modal>
      )}
      <PageTitleArea
        title="Profile"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "Profile", path: "/auth/profile" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="w-full">
            <div className="w-full lg:flex lg:rtl:space-x-reverse lg:space-x-[30px]">
              <div className="lg:w-[270px] mb-6 lg:mb-0 ">
                <div className="w-full rounded-[5px] border border-primary-border">
                  <div className="pt-5">
                    <div>
                      <div className="w-full mb-2.5 px-[18px]">
                        <p className="text-sm font-medium text-white">
                          {language["Seller"]}:
                        </p>
                      </div>
                      <div className="w-full">
                        <a
                          href={process.env.BASE_URL + "seller/login"}
                          target="_blank"
                          className={`flex rtl:space-x-reverse space-x-2.5 items-center py-[14px] px-[18px] first:pt-0  border-b  common-transition w-full last:border-none group ${
                            selectedTab === "seller"
                              ? "border-primary-blue"
                              : "border-[#23262B] hover:border-primary-blue"
                          }`}
                        >
                          <div
                            className={`w-[34px] h-[34px] rounded-full flex justify-center items-center  group-hover:bg-primary-blue group-hover:text-black ${
                              selectedTab === "seller"
                                ? "bg-primary-blue text-black"
                                : "text-primary-blue bg-[#0B0E12] bg-primary-blue/20"
                            }`}
                          >
                            <span>
                              <svg
                                width="19"
                                height="19"
                                viewBox="0 0 19 19"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M1.58203 6.33398L17.4154 6.33399M9.4987 6.33398V17.4173M17.4154 4.75065V14.2507C17.4154 15.9996 15.9976 17.4173 14.2487 17.4173H4.7487C2.9998 17.4173 1.58203 15.9996 1.58203 14.2507L1.58203 4.75065C1.58203 3.00175 2.9998 1.58398 4.7487 1.58398L14.2487 1.58398C15.9976 1.58398 17.4154 3.00175 17.4154 4.75065Z"
                                  stroke="currentColor"
                                  strokeWidth="1.5"
                                  strokeLinecap="round"
                                  strokeLinejoin="round"
                                />
                              </svg>
                            </span>
                          </div>
                          <span
                            className={`text-lg font-medium  group-hover:text-primary-blue common-transition ${
                              selectedTab === "seller"
                                ? "text-primary-blue"
                                : "text-white"
                            }`}
                          >
                            {language["Seller Dashboard"]}
                          </span>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div className="pt-5">
                    <div>
                      <div className="w-full mb-2.5 px-[18px]">
                        {language["User"]}
                      </div>
                      <div className="w-full">
                        <Link
                          href="/auth/profile"
                          type="button"
                          className={`flex rtl:space-x-reverse space-x-2.5 items-center py-[14px] px-[18px] first:pt-0  border-b  common-transition w-full last:border-none group ${
                            lastPath === "profile"
                              ? "border-primary-blue"
                              : "border-[#23262B] hover:border-primary-blue"
                          }`}
                        >
                          <div
                            className={`w-[34px] h-[34px] rounded-full flex justify-center items-center  group-hover:bg-primary-blue group-hover:text-black ${
                              lastPath === "profile"
                                ? "bg-primary-blue text-black"
                                : "text-primary-blue bg-[#0B0E12] bg-primary-blue/20"
                            }`}
                          >
                            <span>
                              <svg
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M17.0711 12.9289C15.9819 11.8398 14.6855 11.0335 13.2711 10.5454C14.786 9.50199 15.7812 7.75578 15.7812 5.78125C15.7812 2.59348 13.1878 0 10 0C6.81223 0 4.21875 2.59348 4.21875 5.78125C4.21875 7.75578 5.21402 9.50199 6.72898 10.5454C5.31453 11.0335 4.01813 11.8398 2.92895 12.9289C1.0402 14.8177 0 17.3289 0 20H1.5625C1.5625 15.3475 5.34754 11.5625 10 11.5625C14.6525 11.5625 18.4375 15.3475 18.4375 20H20C20 17.3289 18.9598 14.8177 17.0711 12.9289ZM10 10C7.67379 10 5.78125 8.1075 5.78125 5.78125C5.78125 3.455 7.67379 1.5625 10 1.5625C12.3262 1.5625 14.2188 3.455 14.2188 5.78125C14.2188 8.1075 12.3262 10 10 10Z"
                                  fill="currentColor"
                                />
                              </svg>
                            </span>
                          </div>
                          <span
                            className={`text-lg font-medium  group-hover:text-primary-blue common-transition ${
                              lastPath === "profile"
                                ? "text-primary-blue"
                                : "text-white"
                            }`}
                          >
                            {language["Profile"]}
                          </span>
                        </Link>
                        <Link
                          href="/auth/profile/order"
                          type="button"
                          className={`flex rtl:space-x-reverse space-x-2.5 items-center py-[14px] px-[18px] first:pt-0  border-b  common-transition w-full last:border-none group ${
                            lastPath === "order"
                              ? "border-primary-blue"
                              : "border-[#23262B] hover:border-primary-blue"
                          }`}
                        >
                          <div
                            className={`w-[34px] h-[34px] rounded-full flex justify-center items-center  group-hover:bg-primary-blue group-hover:text-black ${
                              lastPath === "order"
                                ? "bg-primary-blue text-black"
                                : "text-primary-blue bg-[#0B0E12] bg-primary-blue/20"
                            }`}
                          >
                            <span>
                              <svg
                                width="16"
                                height="20"
                                viewBox="0 0 16 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                className="fill-current"
                              >
                                <path d="M13.8578 2.62037H12.0484V1.81092C12.0484 1.54903 11.7627 1.43001 11.5008 1.43001H10.0962C9.76291 0.477696 8.92963 0.00154151 7.97732 0.00154151C7.03549 -0.0338659 6.17883 0.543635 5.85843 1.43001H4.47759C4.2157 1.43001 3.95381 1.54903 3.95381 1.81092V2.62037H2.14439C1.07214 2.63181 0.194931 3.47767 0.144531 4.54878V18.1906C0.144531 19.2381 1.09684 19.9999 2.14439 19.9999H13.8578C14.9053 19.9999 15.8576 19.2381 15.8576 18.1906V4.54882C15.8072 3.47767 14.93 2.63181 13.8578 2.62037ZM4.90608 2.38232H6.21552C6.44409 2.35443 6.62769 2.18053 6.66788 1.95378C6.80887 1.33978 7.34755 0.899031 7.97732 0.882444C8.60126 0.901355 9.13182 1.34347 9.26292 1.95378C9.30562 2.18837 9.50134 2.3645 9.73908 2.38232H11.0961V4.28693H4.90608V2.38232ZM14.9053 18.1906C14.9053 18.7144 14.3816 19.0477 13.8578 19.0477H2.14439C1.62062 19.0477 1.09684 18.7144 1.09684 18.1906V4.54882C1.14542 4.00363 1.5971 3.5827 2.14439 3.57272H3.95377V4.78692C3.97892 5.05368 4.20996 5.25323 4.47754 5.23929H11.5008C11.7733 5.25419 12.0116 5.05738 12.0484 4.78692V3.57268H13.8577C14.405 3.5827 14.8567 4.00358 14.9053 4.54878V18.1906H14.9053Z" />
                                <path d="M6.16934 10.6445C5.99075 10.4563 5.69428 10.4457 5.50271 10.6208L3.979 12.073L3.3362 11.4064C3.15761 11.2181 2.86114 11.2075 2.66956 11.3826C2.48515 11.5758 2.48515 11.8798 2.66956 12.073L3.64566 13.0729C3.73015 13.1675 3.85218 13.2198 3.97896 13.2158C4.10454 13.214 4.22435 13.1627 4.31225 13.0729L6.16925 11.3112C6.35335 11.1423 6.36565 10.8561 6.19673 10.6721C6.18807 10.6624 6.17891 10.6533 6.16934 10.6445Z" />
                                <path d="M12.9988 11.668H7.52303C7.26005 11.668 7.04688 11.8811 7.04688 12.1441C7.04688 12.4071 7.26005 12.6203 7.52303 12.6203H12.9988C13.2618 12.6203 13.4749 12.4071 13.4749 12.1441C13.4749 11.8811 13.2618 11.668 12.9988 11.668Z" />
                                <path d="M6.16934 6.83399C5.99075 6.64575 5.69428 6.63513 5.50271 6.81021L3.979 8.26246L3.3362 7.59582C3.15761 7.40757 2.86114 7.39696 2.66956 7.57203C2.48515 7.76525 2.48515 8.06924 2.66956 8.26246L3.64566 9.26239C3.73015 9.35699 3.85218 9.4093 3.97896 9.40525C4.10454 9.40347 4.22435 9.35211 4.31225 9.26239L6.16925 7.50063C6.35335 7.33175 6.36565 7.04557 6.19673 6.86152C6.18807 6.8519 6.17891 6.84274 6.16934 6.83399Z" />
                                <path d="M12.9988 7.85742H7.52303C7.26005 7.85742 7.04688 8.0706 7.04688 8.33358C7.04688 8.59656 7.26005 8.80973 7.52303 8.80973H12.9988C13.2618 8.80973 13.4749 8.59656 13.4749 8.33358C13.4749 8.0706 13.2618 7.85742 12.9988 7.85742Z" />
                                <path d="M6.16934 14.4531C5.99075 14.2649 5.69428 14.2543 5.50271 14.4293L3.979 15.8816L3.3362 15.2149C3.15761 15.0267 2.86114 15.0161 2.66956 15.1912C2.48515 15.3844 2.48515 15.6884 2.66956 15.8816L3.64566 16.8815C3.73015 16.9761 3.85218 17.0284 3.97896 17.0244C4.10454 17.0226 4.22435 16.9712 4.31225 16.8815L6.16925 15.1198C6.35335 14.9509 6.36565 14.6647 6.19673 14.4806C6.18807 14.4711 6.17891 14.4619 6.16934 14.4531Z" />
                                <path d="M12.9988 15.4766H7.52303C7.26005 15.4766 7.04688 15.6897 7.04688 15.9527C7.04688 16.2157 7.26005 16.4289 7.52303 16.4289H12.9988C13.2618 16.4289 13.4749 16.2157 13.4749 15.9527C13.4749 15.6897 13.2618 15.4766 12.9988 15.4766Z" />
                              </svg>
                            </span>
                          </div>
                          <span
                            className={`text-lg font-medium  group-hover:text-primary-blue common-transition ${
                              lastPath === "order"
                                ? "text-primary-blue"
                                : "text-white"
                            }`}
                          >
                            {language["My Order"]}
                          </span>
                        </Link>
                        <Link
                          href="/auth/profile/favorites"
                          type="button"
                          className={`flex rtl:space-x-reverse space-x-2.5 items-center py-[14px] px-[18px] first:pt-0  border-b  common-transition w-full last:border-none group ${
                            lastPath === "favorites"
                              ? "border-primary-blue"
                              : "border-[#23262B] hover:border-primary-blue"
                          }`}
                        >
                          <div
                            className={`w-[34px] h-[34px] rounded-full flex justify-center items-center  group-hover:bg-primary-blue group-hover:text-black ${
                              lastPath === "favorites"
                                ? "bg-primary-blue text-black"
                                : "text-primary-blue bg-[#0B0E12] bg-primary-blue/20"
                            }`}
                          >
                            <span>
                              <svg
                                width="20"
                                height="18"
                                viewBox="0 0 20 18"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                className="fill-current"
                              >
                                <path d="M9.99998 17.8873C9.71525 17.8873 9.44075 17.7842 9.22682 17.5968C8.41887 16.8903 7.63991 16.2264 6.95265 15.6408L6.94915 15.6377C4.93423 13.9207 3.19427 12.4378 1.98364 10.9771C0.630339 9.34409 0 7.79578 0 6.10434C0 4.46097 0.563506 2.94485 1.58661 1.83508C2.62191 0.712189 4.0425 0.09375 5.58715 0.09375C6.74163 0.09375 7.79891 0.45874 8.72954 1.1785C9.1992 1.54181 9.62492 1.98645 9.99998 2.5051C10.3752 1.98645 10.8008 1.54181 11.2706 1.1785C12.2012 0.45874 13.2585 0.09375 14.413 0.09375C15.9575 0.09375 17.3782 0.712189 18.4135 1.83508C19.4366 2.94485 20 4.46097 20 6.10434C20 7.79578 19.3698 9.34409 18.0165 10.9769C16.8058 12.4378 15.066 13.9205 13.0514 15.6374C12.363 16.224 11.5828 16.8889 10.773 17.5971C10.5592 17.7842 10.2846 17.8873 9.99998 17.8873ZM5.58715 1.26532C4.37362 1.26532 3.25881 1.74963 2.44781 2.62915C1.62475 3.52194 1.17142 4.75607 1.17142 6.10434C1.17142 7.52692 1.70013 8.79919 2.88558 10.2296C4.03136 11.6122 5.73562 13.0645 7.70888 14.7462L7.71254 14.7492C8.40239 15.3371 9.1844 16.0036 9.9983 16.7153C10.8171 16.0023 11.6003 15.3347 12.2915 14.7458C14.2647 13.0642 15.9688 11.6122 17.1145 10.2296C18.2998 8.79919 18.8285 7.52692 18.8285 6.10434C18.8285 4.75607 18.3752 3.52194 17.5522 2.62915C16.7413 1.74963 15.6263 1.26532 14.413 1.26532C13.524 1.26532 12.7078 1.54791 11.9871 2.10516C11.3449 2.60199 10.8975 3.23004 10.6352 3.66949C10.5003 3.89548 10.2629 4.03036 9.99998 4.03036C9.73707 4.03036 9.49965 3.89548 9.36476 3.66949C9.10261 3.23004 8.65523 2.60199 8.01283 2.10516C7.29216 1.54791 6.47597 1.26532 5.58715 1.26532Z" />
                              </svg>
                            </span>
                          </div>
                          <span
                            className={`text-lg font-medium  group-hover:text-primary-blue common-transition ${
                              lastPath === "favorites"
                                ? "text-primary-blue"
                                : "text-white"
                            }`}
                          >
                            {language["Favorites"]}
                          </span>
                        </Link>
                        <Link
                          href="/auth/profile/tickets"
                          type="button"
                          className={`flex rtl:space-x-reverse space-x-2.5 items-center py-[14px] px-[18px] first:pt-0  border-b  common-transition w-full last:border-none group ${
                            lastPath === "tickets"
                              ? "border-primary-blue"
                              : "border-[#23262B] hover:border-primary-blue"
                          }`}
                        >
                          <div
                            className={`w-[34px] h-[34px] rounded-full flex justify-center items-center  group-hover:bg-primary-blue group-hover:text-black ${
                              lastPath === "tickets"
                                ? "bg-primary-blue text-black"
                                : "text-primary-blue bg-[#0B0E12] bg-primary-blue/20"
                            }`}
                          >
                            <span>
                              <svg
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M1.66797 17.5C2.08464 16.7424 3.66797 15.2273 6.66797 15.2273C9.66797 15.2273 11.2513 13.4091 11.668 12.5M6.66797 6.66667V4.16667C6.66797 3.24619 7.41416 2.5 8.33464 2.5H16.668C17.5884 2.5 18.3346 3.24619 18.3346 4.16667V10.8333C18.3346 11.7538 17.5884 12.5 16.668 12.5H13.9511M10.0013 5.83333H15.0013M8.33464 10.8333C8.33464 11.7538 7.58844 12.5 6.66797 12.5C5.74749 12.5 5.0013 11.7538 5.0013 10.8333C5.0013 9.91286 5.74749 9.16667 6.66797 9.16667C7.58844 9.16667 8.33464 9.91286 8.33464 10.8333Z"
                                  stroke="currentColor"
                                  strokeWidth="1.5"
                                  strokeLinecap="round"
                                />
                                <path
                                  d="M12.5 9.16699H15"
                                  stroke="currentColor"
                                  strokeWidth="1.5"
                                  strokeLinecap="round"
                                />
                              </svg>
                            </span>
                          </div>
                          <span
                            className={`text-lg font-medium  group-hover:text-primary-blue common-transition ${
                              lastPath === "tickets"
                                ? "text-primary-blue"
                                : "text-white"
                            }`}
                          >
                            {language["Support Ticket"] || "Support Ticket"}
                          </span>
                        </Link>
                        <Link
                          href="security"
                          type="button"
                          className={`flex rtl:space-x-reverse space-x-2.5 items-center py-[14px] px-[18px] first:pt-0  border-b  common-transition w-full last:border-none group ${
                            selectedTab === "security"
                              ? "border-primary-blue"
                              : "border-[#23262B] hover:border-primary-blue"
                          }`}
                        >
                          <div
                            className={`w-[34px] h-[34px] rounded-full flex justify-center items-center  group-hover:bg-primary-blue group-hover:text-black ${
                              selectedTab === "security"
                                ? "bg-primary-blue text-black"
                                : "text-primary-blue bg-[#0B0E12] bg-primary-blue/20"
                            }`}
                          >
                            <span>
                              <svg
                                width="17"
                                height="19"
                                viewBox="0 0 17 19"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                className="fill-current"
                              >
                                <path d="M14.0404 6.669V5.54167C14.0404 4.07193 13.4565 2.66238 12.4172 1.62312C11.378 0.583853 9.96844 0 8.4987 0C7.02896 0 5.61941 0.583853 4.58015 1.62312C3.54088 2.66238 2.95703 4.07193 2.95703 5.54167V6.669C2.25194 6.97673 1.6518 7.48325 1.23001 8.12663C0.808215 8.77 0.583043 9.52235 0.582031 10.2917V15.0417C0.583288 16.0911 1.00073 17.0972 1.74279 17.8392C2.48485 18.5813 3.49094 18.9987 4.54036 19H12.457C13.5065 18.9987 14.5125 18.5813 15.2546 17.8392C15.9967 17.0972 16.4141 16.0911 16.4154 15.0417V10.2917C16.4144 9.52235 16.1892 8.77 15.7674 8.12663C15.3456 7.48325 14.7455 6.97673 14.0404 6.669ZM4.54036 5.54167C4.54036 4.49185 4.9574 3.48503 5.69973 2.7427C6.44207 2.00037 7.44888 1.58333 8.4987 1.58333C9.54851 1.58333 10.5553 2.00037 11.2977 2.7427C12.04 3.48503 12.457 4.49185 12.457 5.54167V6.33333H4.54036V5.54167ZM14.832 15.0417C14.832 15.6716 14.5818 16.2756 14.1364 16.721C13.691 17.1664 13.0869 17.4167 12.457 17.4167H4.54036C3.91048 17.4167 3.30639 17.1664 2.86099 16.721C2.41559 16.2756 2.16536 15.6716 2.16536 15.0417V10.2917C2.16536 9.66178 2.41559 9.05769 2.86099 8.61229C3.30639 8.16689 3.91048 7.91667 4.54036 7.91667H12.457C13.0869 7.91667 13.691 8.16689 14.1364 8.61229C14.5818 9.05769 14.832 9.66178 14.832 10.2917V15.0417Z" />
                              </svg>
                            </span>
                          </div>
                          <span
                            className={`text-lg font-medium  group-hover:text-primary-blue common-transition ${
                              lastPath === "security"
                                ? "text-primary-blue"
                                : "text-white"
                            }`}
                          >
                            {language["Security"]}
                          </span>
                        </Link>
                        <button
                          type="button"
                          disabled={isLoading}
                          onClick={() => setToggleModal(true)}
                          className={`flex rtl:space-x-reverse space-x-2.5 items-center py-[14px] px-[18px] first:pt-0  border-b  common-transition w-full last:border-none group ${
                            selectedTab === "logout"
                              ? "border-primary-blue"
                              : "border-[#23262B] hover:border-primary-blue"
                          }`}
                        >
                          <div
                            className={`w-[34px] h-[34px] rounded-full flex justify-center items-center  group-hover:bg-primary-blue group-hover:text-black ${
                              selectedTab === "logout"
                                ? "bg-primary-blue text-black"
                                : "text-primary-blue bg-[#0B0E12] bg-primary-blue/20"
                            }`}
                          >
                            <span>
                              <svg
                                width="19"
                                height="19"
                                viewBox="0 0 19 19"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M14.25 11.084L15.1262 10.2078C15.5168 9.81723 15.5168 9.18407 15.1262 8.79354L14.25 7.91732"
                                  stroke="currentColor"
                                  strokeWidth="1.5"
                                  strokeLinecap="round"
                                  strokeLinejoin="round"
                                />
                                <path
                                  d="M15.043 9.5L10.293 9.5M3.16797 13.6692V5.75251M12.668 13.6692C12.668 14.5436 11.9591 15.2525 11.0846 15.2525H7.91797M12.668 5.75251C12.668 4.87806 11.9591 4.16918 11.0846 4.16918H7.91797M3.87303 15.7225L5.45636 16.7781C6.50857 17.4796 7.91797 16.7253 7.91797 15.4607V3.961C7.91797 2.69639 6.50857 1.94211 5.45636 2.64358L3.87303 3.69914C3.43255 3.99279 3.16797 4.48716 3.16797 5.01655V14.4051C3.16797 14.9345 3.43255 15.4289 3.87303 15.7225Z"
                                  stroke="currentColor"
                                  strokeWidth="1.2"
                                  strokeLinecap="round"
                                />
                              </svg>
                            </span>
                          </div>
                          <span
                            className={`text-lg font-medium  group-hover:text-primary-blue common-transition ${
                              selectedTab === "logout"
                                ? "text-primary-blue"
                                : "text-white"
                            }`}
                          >
                            {language["Logout"]}
                          </span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="flex-1">
                <div className="w-full  rounded-xl">{children}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

export default isAuth(Layout);
