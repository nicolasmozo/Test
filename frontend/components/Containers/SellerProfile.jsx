"use client";
import React, { useState } from "react";
import ProductCard from "@/components/Common/Card/ProductCard";
import { useSellerProductsQuery } from "@/store/features/seller/apiSlice";
import SvgLoader from "@/components/Helper/Loader/SvgLoader";
import PaginateObserver from "@/components/Helper/PaginateObserver";
import { useDispatch, useSelector } from "react-redux";
import { sellerProductPageIncrease } from "@/store/features/pagination/paginationSlice";
import StringLang from "@/utilities/StringLang";

function SellerProfile({ datas }) {
  const dispatch = useDispatch();
  const page = useSelector((state) => state.pagination.sellerProductPage);

  const paginationHandler = () => {
    dispatch(sellerProductPageIncrease());
  };
  const { data, isFetching } = useSellerProductsQuery({
    page: page,
    userName: datas?.author?.user_name,
  });
  if (datas && datas.author) {
    const { author, total_sale, total_review, average_rating } = datas;
    return (
      <>
        <div className="w-full mt-11 pb-[100px]">
          <div className="theme-container mx-auto">
            <div className="w-full lg:px-[190px] ">
              {/*Seller Profile Info*/}
              <div className="w-full bg-black px-[29px] py-10 rounded-lg mb-[30px]">
                <div className="w-full flex md:flex-row flex-col space-y-5 md:space-y-0 md:justify-between md:items-center items-start mb-[30px]">
                  <div className="md:flex md:rtl:space-x-reverse space-x-4">
                    <div className="w-[100px] h-[100px] rounded-full overflow-hidden mb-3 md:mb-0">
                      <img
                        src={process.env.BASE_URL + author.image}
                        alt=""
                        className="w-full h-full object-cover"
                      />
                    </div>
                    <div>
                      <div className="flex rtl:space-x-reverse space-x-2 mt-3">
                        <h1 className="text-white text-xl font-bold notranslate">
                          {author.name}
                        </h1>
                        <span>
                          <svg
                            width="18"
                            height="19"
                            viewBox="0 0 18 19"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M16.6557 7.83896C16.3851 7.68162 16.1419 7.48121 15.9357 7.24563C15.9566 6.91764 16.0347 6.59584 16.1666 6.2948C16.4091 5.61063 16.6832 4.83563 16.2432 4.23313C15.8032 3.63063 14.9724 3.6498 14.2432 3.66646C13.921 3.69961 13.5955 3.67763 13.2807 3.60146C13.113 3.32855 12.9932 3.02895 12.9266 2.71563C12.7199 2.01146 12.4841 1.21563 11.7599 0.977296C11.0616 0.752296 10.4149 1.2473 9.84323 1.6823C9.59656 1.90756 9.31074 2.08578 8.9999 2.20813C8.68581 2.08677 8.39681 1.90851 8.1474 1.6823C7.5774 1.2498 6.93323 0.749796 6.23156 0.978129C5.50906 1.21313 5.27323 2.01146 5.0649 2.71563C4.99834 3.02793 4.87974 3.32682 4.71406 3.5998C4.39866 3.67576 4.07275 3.6983 3.7499 3.66646C3.01823 3.64646 2.19406 3.6248 1.7499 4.23313C1.30573 4.84146 1.58323 5.61063 1.82656 6.29396C1.96026 6.59455 2.03955 6.91649 2.06073 7.2448C1.85496 7.48069 1.61204 7.68139 1.34156 7.83896C0.731562 8.25563 0.0390625 8.7298 0.0390625 9.4998C0.0390625 10.2698 0.731562 10.7423 1.34156 11.1606C1.61198 11.3179 1.8549 11.5184 2.06073 11.754C2.04178 12.0821 1.96475 12.4044 1.83323 12.7056C1.59156 13.389 1.31823 14.164 1.7574 14.7665C2.19656 15.369 3.0249 15.3498 3.7574 15.3331C4.07987 15.2999 4.40564 15.3219 4.72073 15.3981C4.88771 15.6713 5.00718 15.9708 5.07406 16.284C5.28073 16.9881 5.51656 17.784 6.24073 18.0223C6.35683 18.0595 6.47797 18.0786 6.5999 18.079C7.1859 17.9949 7.73055 17.7284 8.15656 17.3173C8.40324 17.092 8.68906 16.9138 8.9999 16.7915C9.31398 16.9128 9.60299 17.0911 9.8524 17.3173C10.4232 17.7531 11.0699 18.2506 11.7691 18.0215C12.4916 17.7865 12.7274 16.9881 12.9357 16.2848C13.0025 15.9719 13.122 15.6726 13.2891 15.3998C13.6033 15.3233 13.9282 15.3008 14.2499 15.3331C14.9816 15.3506 15.8057 15.3748 16.2499 14.7665C16.6941 14.1581 16.4166 13.389 16.1732 12.7048C16.0404 12.4045 15.9612 12.0832 15.9391 11.7556C16.1449 11.5195 16.3882 11.3188 16.6591 11.1615C17.2691 10.7448 17.9616 10.2698 17.9616 9.4998C17.9616 8.7298 17.2666 8.25646 16.6557 7.83896Z"
                              fill="url(#paint0_linear_7666_8899)"
                            />
                            <path
                              d="M8.1667 11.7915C8.08462 11.7917 8.00332 11.7755 7.92751 11.7441C7.8517 11.7126 7.78288 11.6664 7.72504 11.6082L6.05837 9.94151C5.94797 9.82303 5.88787 9.66632 5.89072 9.5044C5.89358 9.34249 5.95917 9.188 6.07368 9.07349C6.18819 8.95898 6.34268 8.89338 6.5046 8.89053C6.66652 8.88767 6.82322 8.94777 6.9417 9.05817L8.22504 10.3415L11.125 8.16651C11.2576 8.06705 11.4243 8.02435 11.5884 8.04779C11.7525 8.07123 11.9006 8.1589 12 8.29151C12.0995 8.42411 12.1422 8.5908 12.1188 8.75489C12.0953 8.91899 12.0076 9.06705 11.875 9.16651L8.5417 11.6665C8.43349 11.7476 8.30192 11.7914 8.1667 11.7915Z"
                              fill="white"
                            />
                            <defs>
                              <linearGradient
                                id="paint0_linear_7666_8899"
                                x1="0.0390625"
                                y1="0.920898"
                                x2="19.6252"
                                y2="16.218"
                                gradientUnits="userSpaceOnUse"
                              >
                                <stop stop-color="#00D3FB" />
                                <stop offset="1" stop-color="#0086FF" />
                              </linearGradient>
                            </defs>
                          </svg>
                        </span>
                      </div>

                      <div className="flex rtl:space-x-reverse space-x-1.5 items-center mt-2.5">
                        <span>
                          <svg
                            width="23"
                            height="22"
                            viewBox="0 0 23 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M11.0298 0L13.5062 7.60081H21.5198L15.0366 12.2984L17.513 19.8992L11.0298 15.2016L4.54665 19.8992L7.023 12.2984L0.539837 7.60081H8.55346L11.0298 0Z"
                              fill="#FFB321"
                            />
                          </svg>
                        </span>
                        <span className="text-lg text-white font-semibold">
                          {average_rating}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="grid sm:grid-cols-3 grid-cols-1 gap-5 mb-[30px]">
                  <div className="w-full h-[120px] bg-[#0B0E13] flex items-center px-5 rounded-md">
                    <div className="flex rtl:space-x-reverse space-x-[14px]">
                      <div className="w-[48px] h-[48px] rounded-full flex justify-center items-center bg-primary-blue/20">
                        <span className="text-primary-blue">
                          <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6 4H18C20.2091 4 22 5.79086 22 8V13C22 15.2091 20.2091 17 18 17H10C7.79086 17 6 15.2091 6 13V4ZM6 4C6 2.89543 5.10457 2 4 2H2"
                              stroke="currentColor"
                              stroke-width="1.5"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M11 20.5C11 21.3284 10.3284 22 9.5 22C8.67157 22 8 21.3284 8 20.5C8 19.6716 8.67157 19 9.5 19C10.3284 19 11 19.6716 11 20.5Z"
                              stroke="currentColor"
                              stroke-width="1.5"
                            />
                            <path
                              d="M20 20.5C20 21.3284 19.3284 22 18.5 22C17.6716 22 17 21.3284 17 20.5C17 19.6716 17.6716 19 18.5 19C19.3284 19 20 19.6716 20 20.5Z"
                              stroke="currentColor"
                              stroke-width="1.5"
                            />
                            <path
                              d="M11 8.5H17"
                              stroke="currentColor"
                              stroke-width="1.5"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M11 12.5H17"
                              stroke="currentColor"
                              stroke-width="1.5"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </span>
                      </div>
                      <div>
                        <p className="text-lg leading-7">
                          <StringLang string="Total Sales" />
                        </p>
                        <p className="text-2xl font-semibold text-white">
                          {total_sale}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div className="w-full h-[120px] bg-[#0B0E13] flex items-center px-5 rounded-md">
                    <div className="flex rtl:space-x-reverse space-x-[14px]">
                      <div className="w-[48px] h-[48px] rounded-full flex justify-center items-center bg-primary-blue/20">
                        <span className="text-primary-blue">
                          <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M10.0328 3.27141C10.8375 1.5762 13.1625 1.57619 13.9672 3.27141L15.3579 6.20118C15.6774 6.87435 16.2951 7.34094 17.0096 7.44888L20.1193 7.91869C21.9187 8.19053 22.6371 10.4895 21.3351 11.8091L19.0849 14.0896C18.5679 14.6136 18.332 15.3685 18.454 16.1084L18.9852 19.3285C19.2926 21.1918 17.4116 22.6126 15.8022 21.7329L13.0208 20.2126C12.3817 19.8633 11.6183 19.8633 10.9792 20.2126L8.19776 21.7329C6.58839 22.6126 4.70742 21.1918 5.01479 19.3286L5.54599 16.1084C5.66804 15.3685 5.43211 14.6136 4.91508 14.0896L2.66488 11.8091C1.36287 10.4895 2.08133 8.19053 3.88066 7.91869L6.99037 7.44888C7.70489 7.34094 8.32257 6.87435 8.64211 6.20118L10.0328 3.27141Z"
                              stroke="currentColor"
                              stroke-width="1.5"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </span>
                      </div>
                      <div>
                        <p className="text-lg leading-7">
                          <StringLang string="Total Review" />
                        </p>
                        <p className="text-2xl font-semibold text-white">
                          {total_review}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div className="w-full h-[120px] bg-[#0B0E13] flex items-center px-5 rounded-md">
                    <div className="flex rtl:space-x-reverse space-x-[14px]">
                      <div className="w-[48px] h-[48px] rounded-full flex justify-center items-center bg-primary-blue/20">
                        <span className="text-primary-blue">
                          <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M1.25 6C1.25 3.37665 3.37665 1.25 6 1.25H18C20.6234 1.25 22.75 3.37665 22.75 6V13C22.75 13.4142 22.4142 13.75 22 13.75C21.5858 13.75 21.25 13.4142 21.25 13V6C21.25 4.20507 19.7949 2.75 18 2.75H6C4.20507 2.75 2.75 4.20507 2.75 6V18C2.75 19.7949 4.20507 21.25 6 21.25H13C13.4142 21.25 13.75 21.5858 13.75 22C13.75 22.4142 13.4142 22.75 13 22.75H6C3.37665 22.75 1.25 20.6234 1.25 18V6ZM21.4939 16.4356C21.8056 16.7083 21.8372 17.1822 21.5645 17.4939L18.6946 20.7738C18.0779 21.4786 17.0156 21.5729 16.2843 20.9879L14.5315 19.5857C14.2081 19.3269 14.1556 18.8549 14.4144 18.5315C14.6731 18.208 15.1451 18.1556 15.4685 18.4144L17.2214 19.8166C17.3258 19.9002 17.4776 19.8867 17.5657 19.786L20.4356 16.5061C20.7084 16.1944 21.1822 16.1628 21.4939 16.4356ZM12 5.25C12.4142 5.25 12.75 5.58579 12.75 6V10.1454C13.483 10.4421 14 11.1607 14 12C14 13.1046 13.1046 14 12 14C11.7229 14 11.4589 13.9436 11.2189 13.8417L9.53033 15.5303C9.23744 15.8232 8.76256 15.8232 8.46967 15.5303C8.17678 15.2374 8.17678 14.7626 8.46967 14.4697L10.1583 12.7811C10.0564 12.5411 10 12.2771 10 12C10 11.1607 10.517 10.4421 11.25 10.1454V6C11.25 5.58579 11.5858 5.25 12 5.25Z"
                              fill="currentColor"
                            />
                          </svg>
                        </span>
                      </div>
                      <div>
                        <p className="text-lg leading-7">
                          <StringLang string="Time" />
                        </p>
                        <p className="text-2xl font-semibold text-white">
                          <StringLang string=" Instant" />
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <h2 className="text-2xl font-bold leading-8 text-white mb-3.5">
                  <StringLang string="About Seller" />
                </h2>
                <p
                  className="text-base leading-6"
                  dangerouslySetInnerHTML={{
                    __html: author.about_me.replace(/<[^>]*>/g, ""),
                  }}
                ></p>
              </div>
              {/*products*/}
              <p className="text-2xl font-bold text-white mb-4">
                <StringLang string="Seller Products" />
              </p>
              {data && data?.products && data?.products?.data.length > 0 ? (
                <PaginateObserver
                  currentPage={page}
                  lastPage={data?.products?.last_page}
                  loading={isFetching}
                  handler={paginationHandler}
                  type="onclick"
                >
                  <div className="grid xl:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6 mb-[30px]">
                    {data.products.data.map((product, i) => (
                      <ProductCard {...product} key={i} />
                    ))}
                  </div>
                </PaginateObserver>
              ) : isFetching ? (
                <div className="flex justify-center">
                  <span>
                    <SvgLoader />
                  </span>
                </div>
              ) : (
                <div className="mt-5 flex justify-center">
                  <span className="text-sm text-primary-black">
                    <StringLang string="No Products Found!" />
                  </span>
                </div>
              )}
            </div>
          </div>
        </div>
      </>
    );
  }
}

export default SellerProfile;
