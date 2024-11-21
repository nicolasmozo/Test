"use client";
import React, { useEffect, useState } from "react";
import Link from "next/link";
import {
  useAddWishListMutation,
  useDeleteWishListMutation,
  useLazyGetWishListQuery,
} from "@/store/features/wishlist/apiSlice";
import { useRouter } from "next/navigation";
import { useSelector } from "react-redux";
import useCurrency from "@/hooks/useCurrency";
import useLanguage from "@/hooks/useLanguage";

function ProductCard(props) {
  const router = useRouter();
  const isAuth = useSelector((state) => state.auth.accessToken);
  const [getWishListQuery, { data }] = useLazyGetWishListQuery();
  const {
    type = "col",
    thumbnail_image,
    slug,
    regular_price,
    offer_price,
    name,
    total_sale,
    average_rating,
    id,
  } = props;
  const [addWishList, { isLoading, isError, error }] = useAddWishListMutation();
  const [deleteWishlist, { isLoading: deleting }] = useDeleteWishListMutation();
  const handleWishlist = (product) => {
    if (!!isAuth) {
      if (data?.products?.find((item) => item?.slug === slug)) {
        deleteWishlist({ product });
      } else {
        addWishList({ product });
      }
    } else {
      router.push("/auth/signin");
    }
  };

  useEffect(() => {
    if (!!isAuth) {
      getWishListQuery();
    }
  }, [isAuth]);
  const calculatePrice = useCurrency();
  const language = useLanguage();
  if (type === "row") {
    return (
      <div
        {...props}
        className={`product-row-item w-full group rounded overflow-hidden ${
          props.className || "bg-[#0B0E12]"
        } border border-[#3C3E42]`}
      >
        <div className="w-full  p-2.5 flex rtl:space-x-reverse space-x-4 items-center ">
          <div className="w-[160px] h-[126px] relative rounded overflow-hidden">
            <img
              src={process.env.BASE_URL + thumbnail_image}
              alt=""
              className=" w-full h-full object-cover transform scale-100 group-hover:scale-105 common-transition"
            />
            <div className="absolute top-[6px] left-[6px]">
              <button
                disabled={isLoading}
                onClick={() =>
                  handleWishlist({
                    thumbnail_image,
                    slug,
                    regular_price,
                    offer_price,
                    name,
                    total_sale,
                    average_rating,
                    id,
                  })
                }
                type="button"
                className={`w-7 h-7 bg-white text-[#616161] items-center justify-center flex hover:bg-primary-blue common-transition  hover:text-primary-black  rounded-full`}
              >
                <span>
                  {data?.products?.find((item) => item?.slug === slug) ? (
                    <svg
                      width="18"
                      height="18"
                      viewBox="0 0 18 18"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M13.2188 1.05469C12.242 1.05469 11.3465 1.3642 10.5572 1.97466C9.80044 2.5599 9.29661 3.30532 9 3.84736C8.70339 3.30529 8.19956 2.5599 7.44282 1.97466C6.6535 1.3642 5.758 1.05469 4.78125 1.05469C2.05552 1.05469 0 3.28419 0 6.24073C0 9.43481 2.5644 11.6202 6.44657 14.9285C7.10582 15.4903 7.85306 16.1271 8.62973 16.8063C8.73211 16.896 8.86359 16.9453 9 16.9453C9.13641 16.9453 9.26789 16.896 9.37027 16.8063C10.147 16.1271 10.8942 15.4903 11.5539 14.9281C15.4356 11.6202 18 9.43481 18 6.24073C18 3.28419 15.9445 1.05469 13.2188 1.05469Z"
                        fill="#EB5757"
                      />
                    </svg>
                  ) : (
                    <svg
                      width="18"
                      height="16"
                      className="fill-current"
                      viewBox="0 0 18 16"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path d="M8.997 15.1457C8.76252 15.1457 8.53645 15.0608 8.36028 14.9065C7.6949 14.3247 7.05341 13.7779 6.48743 13.2956L6.48454 13.2931C4.8252 11.879 3.39229 10.6579 2.3953 9.45493C1.28082 8.11011 0.761719 6.83503 0.761719 5.44208C0.761719 4.08872 1.22578 2.84016 2.06834 1.92623C2.92094 1.00149 4.09084 0.492188 5.3629 0.492188C6.31365 0.492188 7.18435 0.792768 7.95075 1.38551C8.33753 1.68471 8.68812 2.05088 8.997 2.478C9.306 2.05088 9.65646 1.68471 10.0434 1.38551C10.8098 0.792768 11.6805 0.492188 12.6312 0.492188C13.9032 0.492188 15.0732 1.00149 15.9258 1.92623C16.7683 2.84016 17.2323 4.08872 17.2323 5.44208C17.2323 6.83503 16.7133 8.11011 15.5988 9.4548C14.6018 10.6579 13.169 11.8789 11.51 13.2929C10.943 13.7759 10.3005 14.3235 9.63359 14.9067C9.45754 15.0608 9.23135 15.1457 8.997 15.1457ZM5.3629 1.45701C4.36352 1.45701 3.44545 1.85586 2.77756 2.58016C2.09975 3.3154 1.72641 4.33175 1.72641 5.44208C1.72641 6.61362 2.16183 7.66138 3.13808 8.83932C4.08167 9.97793 5.48517 11.174 7.11021 12.5589L7.11322 12.5614C7.68133 13.0456 8.32534 13.5944 8.99562 14.1805C9.66991 13.5933 10.3149 13.0435 10.8842 12.5586C12.5091 11.1737 13.9125 9.97793 14.856 8.83932C15.8322 7.66138 16.2676 6.61362 16.2676 5.44208C16.2676 4.33175 15.8942 3.3154 15.2164 2.58016C14.5487 1.85586 13.6305 1.45701 12.6312 1.45701C11.8991 1.45701 11.227 1.68973 10.6335 2.14865C10.1046 2.5578 9.73613 3.07502 9.52012 3.43692C9.40904 3.62302 9.21351 3.73411 8.997 3.73411C8.78049 3.73411 8.58496 3.62302 8.47387 3.43692C8.25799 3.07502 7.88955 2.5578 7.36052 2.14865C6.76703 1.68973 6.09487 1.45701 5.3629 1.45701Z" />
                    </svg>
                  )}
                </span>
              </button>
            </div>
          </div>
          <div className="flex-1">
            <div className="w-full pr-[14px]">
              {/*price*/}
              <div className="flex rtl:space-x-reverse space-x-2.5 items-center mb-1.5">
                <span className="sm:text-xl text-lg leading-5 font-bold text-primary-blue notranslate">
                  {offer_price
                    ? calculatePrice(Number(offer_price))
                    : calculatePrice(Number(regular_price))}
                </span>
                {offer_price && parseInt(offer_price) > 0 ? (
                  <span className="sm:text-sm text-xs leading-4 line-through text-[#7B7B7B] notranslate">
                    {calculatePrice(Number(regular_price))}
                  </span>
                ) : (
                  ""
                )}
              </div>
              <Link href={`/products/${slug}`}>
                <h1 className="sm:text-xl text-lg text-white sm:leading-[24px] line-clamp-1 mb-4 font-semibold notranslate">
                  {name}
                </h1>
              </Link>
              <div className="flex justify-between items-center">
                <div className="inline-block py-[6px] px-2.5 rounded-sm bg-[#343434] ">
                  <span className="sm:text-sm text-xs font-semibold text-[#A8ABA9]">
                    {total_sale + ` ${language["Sale"]}`}
                  </span>
                </div>
                <div className="flex rtl:space-x-reverse space-x-1 items-center">
                  <span>
                    <svg
                      width="21"
                      height="21"
                      viewBox="0 0 21 21"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M8.66667 3.15302C9.33724 1.74034 11.2747 1.74033 11.9453 3.15301L13.1042 5.59449C13.3705 6.15546 13.8852 6.54429 14.4807 6.63424L17.0721 7.02575C18.5715 7.25228 19.1703 9.16813 18.0853 10.2677L16.2101 12.1682C15.7792 12.6048 15.5826 13.234 15.6843 13.8505L16.127 16.534C16.3831 18.0866 14.8157 19.2707 13.4745 18.5376L11.1567 17.2707C10.6241 16.9796 9.98787 16.9796 9.4553 17.2707L7.13746 18.5376C5.79632 19.2707 4.22884 18.0866 4.48498 16.534L4.92765 13.8505C5.02936 13.234 4.83275 12.6048 4.40189 12.1682L2.52672 10.2677C1.44171 9.16813 2.04043 7.25229 3.53987 7.02575L6.1313 6.63424C6.72673 6.54429 7.24146 6.15546 7.50775 5.59449L8.66667 3.15302Z"
                        fill="#FFB321"
                      />
                    </svg>
                  </span>
                  <span className="sm:text-lg text-base font-medium leading-[21px] text-white">
                    {average_rating}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  } else {
    return (
      <div
        {...props}
        className={`product-col-item w-full group rounded overflow-hidden ${
          props.className || "bg-[#0B0E12]"
        } border border-[#3C3E42]`}
      >
        <div className="w-full  p-[6px] flex flex-col space-y-4">
          <div className="w-full h-[194px] relative  rounded-t overflow-hidden">
            <img
              src={process.env.BASE_URL + thumbnail_image}
              alt=""
              className=" w-full h-full  object-cover transform scale-100 group-hover:scale-105 common-transition"
            />
            <div className="absolute top-[6px] left-[6px]">
              <button
                type="button"
                disabled={isLoading}
                onClick={() =>
                  handleWishlist({
                    thumbnail_image,
                    slug,
                    regular_price,
                    offer_price,
                    name,
                    total_sale,
                    average_rating,
                    id,
                  })
                }
                className={`w-7 h-7 items-center justify-center flex hover:bg-primary-blue common-transition  hover:text-primary-black bg-white text-[#616161] 
                 rounded-full`}
              >
                <span>
                  {data?.products?.find((item) => item?.slug === slug) ? (
                    <svg
                      width="18"
                      height="18"
                      viewBox="0 0 18 18"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M13.2188 1.05469C12.242 1.05469 11.3465 1.3642 10.5572 1.97466C9.80044 2.5599 9.29661 3.30532 9 3.84736C8.70339 3.30529 8.19956 2.5599 7.44282 1.97466C6.6535 1.3642 5.758 1.05469 4.78125 1.05469C2.05552 1.05469 0 3.28419 0 6.24073C0 9.43481 2.5644 11.6202 6.44657 14.9285C7.10582 15.4903 7.85306 16.1271 8.62973 16.8063C8.73211 16.896 8.86359 16.9453 9 16.9453C9.13641 16.9453 9.26789 16.896 9.37027 16.8063C10.147 16.1271 10.8942 15.4903 11.5539 14.9281C15.4356 11.6202 18 9.43481 18 6.24073C18 3.28419 15.9445 1.05469 13.2188 1.05469Z"
                        fill="#EB5757"
                      />
                    </svg>
                  ) : (
                    <svg
                      width="18"
                      height="16"
                      className="fill-current"
                      viewBox="0 0 18 16"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path d="M8.997 15.1457C8.76252 15.1457 8.53645 15.0608 8.36028 14.9065C7.6949 14.3247 7.05341 13.7779 6.48743 13.2956L6.48454 13.2931C4.8252 11.879 3.39229 10.6579 2.3953 9.45493C1.28082 8.11011 0.761719 6.83503 0.761719 5.44208C0.761719 4.08872 1.22578 2.84016 2.06834 1.92623C2.92094 1.00149 4.09084 0.492188 5.3629 0.492188C6.31365 0.492188 7.18435 0.792768 7.95075 1.38551C8.33753 1.68471 8.68812 2.05088 8.997 2.478C9.306 2.05088 9.65646 1.68471 10.0434 1.38551C10.8098 0.792768 11.6805 0.492188 12.6312 0.492188C13.9032 0.492188 15.0732 1.00149 15.9258 1.92623C16.7683 2.84016 17.2323 4.08872 17.2323 5.44208C17.2323 6.83503 16.7133 8.11011 15.5988 9.4548C14.6018 10.6579 13.169 11.8789 11.51 13.2929C10.943 13.7759 10.3005 14.3235 9.63359 14.9067C9.45754 15.0608 9.23135 15.1457 8.997 15.1457ZM5.3629 1.45701C4.36352 1.45701 3.44545 1.85586 2.77756 2.58016C2.09975 3.3154 1.72641 4.33175 1.72641 5.44208C1.72641 6.61362 2.16183 7.66138 3.13808 8.83932C4.08167 9.97793 5.48517 11.174 7.11021 12.5589L7.11322 12.5614C7.68133 13.0456 8.32534 13.5944 8.99562 14.1805C9.66991 13.5933 10.3149 13.0435 10.8842 12.5586C12.5091 11.1737 13.9125 9.97793 14.856 8.83932C15.8322 7.66138 16.2676 6.61362 16.2676 5.44208C16.2676 4.33175 15.8942 3.3154 15.2164 2.58016C14.5487 1.85586 13.6305 1.45701 12.6312 1.45701C11.8991 1.45701 11.227 1.68973 10.6335 2.14865C10.1046 2.5578 9.73613 3.07502 9.52012 3.43692C9.40904 3.62302 9.21351 3.73411 8.997 3.73411C8.78049 3.73411 8.58496 3.62302 8.47387 3.43692C8.25799 3.07502 7.88955 2.5578 7.36052 2.14865C6.76703 1.68973 6.09487 1.45701 5.3629 1.45701Z" />
                    </svg>
                  )}
                </span>
              </button>
            </div>
          </div>
          <div className="flex-1">
            <div className="w-full px-2 pb-5">
              {/*price*/}
              <div className="flex rtl:space-x-reverse space-x-2.5 items-center mb-1.5">
                <span className="sm:text-xl text-lg leading-6 font-bold text-primary-blue notranslate">
                  {offer_price
                    ? calculatePrice(offer_price)
                    : calculatePrice(regular_price)}
                </span>
                {offer_price && parseInt(offer_price) > 0 ? (
                  <span className="sm:text-sm text-xs leading-4 line-through text-[#7B7B7B] notranslate">
                    {calculatePrice(regular_price)}
                  </span>
                ) : (
                  ""
                )}
              </div>
              <Link href={`/products/${slug}`}>
                <h1 className="sm:text-xl text-lg text-white sm:leading-6 font-semibold line-clamp-1 mb-4 notranslate">
                  {name}
                </h1>
              </Link>
              <div className="flex justify-between items-center">
                <div className="inline-block py-[6px] px-2.5 rounded-sm bg-[#343434]">
                  <span className="sm:text-sm text-xs font-semibold text-[#A8ABA9]">
                    {total_sale + ` ${language["Sale"]}`}
                  </span>
                </div>
                <div className="flex rtl:space-x-reverse space-x-1 items-center">
                  <span>
                    <svg
                      width="18"
                      height="18"
                      viewBox="0 0 18 18"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M7.66667 1.72614C8.33724 0.313458 10.2747 0.313455 10.9453 1.72613L12.1042 4.16761C12.3705 4.72858 12.8852 5.11741 13.4807 5.20736L16.0721 5.59887C17.5715 5.8254 18.1703 7.74125 17.0853 8.84086L15.2101 10.7413C14.7792 11.1779 14.5826 11.8071 14.6843 12.4236L15.127 15.1071C15.3831 16.6598 13.8157 17.8438 12.4745 17.1107L10.1567 15.8438C9.62411 15.5527 8.98787 15.5527 8.4553 15.8438L6.13746 17.1107C4.79632 17.8438 3.22884 16.6598 3.48498 15.1071L3.92765 12.4236C4.02936 11.8071 3.83275 11.1779 3.40189 10.7413L1.52672 8.84086C0.441711 7.74125 1.04043 5.82541 2.53987 5.59887L5.1313 5.20736C5.72673 5.11741 6.24146 4.72858 6.50775 4.16761L7.66667 1.72614Z"
                        fill="#FFB321"
                      />
                    </svg>
                  </span>
                  <span className="sm:text-lg text-base font-medium leading-[21px] text-white">
                    {average_rating}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default ProductCard;
