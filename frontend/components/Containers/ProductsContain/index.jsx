"use client";
import React, { useEffect, useState } from "react";
import RangeSlider from "react-range-slider-input";
import "react-range-slider-input/dist/style.css";
import DropDown from "@/components/Helper/DropDown";
import ProductCard from "@/components/Common/Card/ProductCard";
import { useSearchParams } from "next/navigation";
import {
  useLazyShopPageInfoQuery,
  useShopPageInfoQuery,
} from "@/store/features/products/apiSlice";
import SvgLoader from "@/components/Helper/Loader/SvgLoader";
import NoResultFound from "@/components/Ui/NoResultFound";
import PaginateObserver from "@/components/Helper/PaginateObserver";
import Link from "next/link";
import StringLang from "@/utilities/StringLang";
import useLanguage from "@/hooks/useLanguage";
import { useSelector } from "react-redux";
function Sidebar({
  sideBarAction,
  priceRange,
  category,
  max_price,
  rating,
  search,
  resetfilter,
  searchAction,
  ads,
}) {
  return (
    <div
      className={`lg:relative lg:h-auto h-screen overflow-y-scroll lg:overflow-y-auto fixed left-0 top-0 lg:z-[99999999999]  w-full ${
        sideBarAction.filterToogle ? "block" : "lg:block hidden"
      }`}
    >
      <div className=" w-full px-5 py-4 rounded-lg border border-[#23262B] bg-black xl:mb-8">
        <div className="flex lg:hidden justify-end mb-3">
          <button
            onClick={() => sideBarAction.handler(false)}
            type="button"
            className="w-[30px] h-[30px] rounded-full flex justify-center items-center bg-[#F4D9E3]"
          >
            <span>
              <svg
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M5.31106 7.0172C3.67952 5.39415 2.1069 3.8281 0.532319 2.26429C0.142041 1.87678 -0.132922 1.45445 0.0761053 0.874029C0.423175 -0.0896932 1.44419 -0.290469 2.21857 0.474725C3.6582 1.89756 5.10343 3.31591 6.49845 4.78199C6.92772 5.23324 7.13395 5.15855 7.52114 4.75756C8.92653 3.30131 10.3648 1.8765 11.8038 0.453102C12.5675 -0.302544 13.6225 -0.0818314 13.9387 0.883014C14.1281 1.46091 13.8531 1.88352 13.4623 2.273C12.0434 3.68629 10.6324 5.10688 9.21384 6.52017C9.06065 6.67293 8.87575 6.79368 8.67177 6.95626C10.3347 8.61161 11.9304 10.185 13.5077 11.7766C14.2894 12.5653 14.063 13.6262 13.0706 13.9438C12.4814 14.1322 12.074 13.8175 11.6922 13.4347C10.2623 12.002 8.81599 10.5854 7.41256 9.12717C7.05763 8.75819 6.89574 8.81828 6.57617 9.14626C5.1486 10.6118 3.69299 12.0495 2.24635 13.4962C1.85803 13.8846 1.44222 14.1468 0.854979 13.907C-0.0925194 13.5198 -0.292289 12.5881 0.456564 11.8162C1.51741 10.723 2.60239 9.65311 3.68429 8.58016C4.20728 8.06123 4.74682 7.55831 5.31106 7.0172Z"
                  fill="#EB5757"
                />
              </svg>
            </span>
          </button>
        </div>
        {/*categories*/}
        {category.categories && category.categories.length > 0 && (
          <div className="w-full mb-8">
            <p className="text-xl leading-8 font-semibold text-white pb-[6px] border-b border-primary-border  mb-2.5">
              <StringLang string="Categories" />
            </p>
            <ul>
              {category.categories.map((item, i) => (
                <li key={i}>
                  <Link
                    href={`/products?category=${item.slug}`}
                    type="button"
                    className={`w-full flex justify-between text-[#E5E7EB] items-center text-base leading-[35px] hover:text-primary-blue mb-1 
                                  ${
                                    search === item.slug
                                      ? "text-primary-blue"
                                      : ""
                                  }`}
                  >
                    <span>{item?.name}</span>
                    <span>({item?.total_product})</span>
                  </Link>
                </li>
              ))}
            </ul>
          </div>
        )}

        {/*price slider*/}
        <div className="w-full mb-8">
          <p className="text-xl leading-8 font-semibold text-white pb-[6px] border-b border-primary-border  mb-7">
            <StringLang string="Price" />
          </p>
          <div className="price-range mb-3">
            <RangeSlider
              value={priceRange.volume}
              onInput={priceRange.handler}
              min={0}
              max={max_price}
            />
          </div>
          <p className="text-base text-[#E5E7EB]">
            <StringLang string="Price" />:{" "}
            <span className="text-primary-blue">
              {priceRange.volume[0]} - {priceRange.volume[1]}
            </span>
          </p>
        </div>
        {/*rating*/}
        <div className="w-full mb-8">
          <p className="text-xl leading-8 font-semibold text-white pb-[6px] border-b border-primary-border  mb-7">
            <StringLang string="Rating" />
          </p>
          <ul className="flex flex-col space-y-[15px]">
            <li>
              <button
                onClick={() => rating.handler(1)}
                type="button"
                className="w-full flex rtl:space-x-reverse space-x-4 items-center text-base group leading-[35px] hover:text-primary-blue mb-1"
              >
                <div
                  className={`w-[22px] h-[22px] rounded-sm  group-hover:bg-primary-blue common-transition ${
                    rating.ratings.includes(1)
                      ? "bg-primary-blue "
                      : "bg-[#0B0E12]"
                  }`}
                ></div>
                <div className="flex rtl:space-x-reverse space-x-1.5 items-center">
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
                </div>
              </button>
            </li>
            <li>
              <button
                onClick={() => rating.handler(2)}
                type="button"
                className="w-full flex rtl:space-x-reverse space-x-4 items-center text-base group leading-[35px] hover:text-primary-blue mb-1"
              >
                <div
                  className={`w-[22px] h-[22px] rounded-sm  group-hover:bg-primary-blue common-transition ${
                    rating.ratings.includes(2)
                      ? "bg-primary-blue "
                      : "bg-[#0B0E12]"
                  }`}
                ></div>
                <div className="flex rtl:space-x-reverse space-x-1.5 items-center">
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
                </div>
              </button>
            </li>
            <li>
              <button
                onClick={() => rating.handler(3)}
                type="button"
                className="w-full flex rtl:space-x-reverse space-x-4 items-center text-base group leading-[35px] hover:text-primary-blue mb-1"
              >
                <div
                  className={`w-[22px] h-[22px] rounded-sm  group-hover:bg-primary-blue common-transition ${
                    rating.ratings.includes(3)
                      ? "bg-primary-blue "
                      : "bg-[#0B0E12]"
                  }`}
                ></div>
                <div className="flex rtl:space-x-reverse space-x-1.5 items-center">
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
                </div>
              </button>
            </li>
            <li>
              <button
                onClick={() => rating.handler(4)}
                type="button"
                className="w-full flex rtl:space-x-reverse space-x-4 items-center text-base group leading-[35px] hover:text-primary-blue mb-1"
              >
                <div
                  className={`w-[22px] h-[22px] rounded-sm  group-hover:bg-primary-blue common-transition ${
                    rating.ratings.includes(4)
                      ? "bg-primary-blue "
                      : "bg-[#0B0E12]"
                  }`}
                ></div>
                <div className="flex rtl:space-x-reverse space-x-1.5 items-center">
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
                </div>
              </button>
            </li>
            <li>
              <button
                onClick={() => rating.handler(5)}
                type="button"
                className="w-full flex rtl:space-x-reverse space-x-4 items-center text-base group leading-[35px] hover:text-primary-blue mb-1"
              >
                <div
                  className={`w-[22px] h-[22px] rounded-sm  group-hover:bg-primary-blue common-transition ${
                    rating.ratings.includes(5)
                      ? "bg-primary-blue "
                      : "bg-[#0B0E12]"
                  }`}
                ></div>
                <div className="flex rtl:space-x-reverse space-x-1.5 items-center">
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
                </div>
              </button>
            </li>
          </ul>
        </div>
        {/*actions*/}
        <div className="flex justify-between items-center">
          <button
            onClick={() => resetfilter()}
            type="button"
            className="text-xl leading-8 text-[#EB5757]"
          >
            <StringLang string="Clear all" />
          </button>
          <button onClick={searchAction} type="button" className="group">
            <div className="lg:py-4 lg:px-8 py-3 px-5 flex rtl:space-x-reverse space-x-2.5 items-center bg-primary-blue group- hover:bg-white hover:text-black  common-transition rounded-[5px]">
              <span className="text-primary-black  common-transition group-hover:text-black text-base font-medium leading-5">
                <StringLang string="Search" />
              </span>
            </div>
          </button>
        </div>
      </div>
      {Number(ads?.status) === 1 && (
        <a href={ads?.link} target="_blank" className="w-full block">
          <div className="w-full xl:block hidden">
            <img
              src={process.env.BASE_URL + ads?.image}
              alt=""
              className="w-full object-cover"
            />
          </div>
        </a>
      )}
    </div>
  );
}
function Index({ categories, max_price, searchKey }) {
  const { settings } = useSelector((state) => state.defaultSettings);
  const searchParams = useSearchParams();
  const categorySlug = searchParams.get("category");
  // component states
  const [filterToogle, setFilterToogle] = useState(false);
  const [volume, setVolume] = useState([0, max_price]);
  const [ratings, setRatings] = useState([]);
  const ratingHandler = (value) => {
    // Create a copy of the ratings array
    let newArray = [...ratings];
    const index = newArray.indexOf(value);
    if (index !== -1) {
      // Item exists, remove it
      newArray.splice(index, 1);
    } else {
      // Item doesn't exist, add it
      newArray.push(value);
    }
    // Update state with the new array
    setRatings(newArray);
  };
  const volumeHandler = (value) => {
    setVolume(value);
  };
  const reset = () => {
    setRatings([]);
    setVolume([0, max_price]);
  };
  const language = useLanguage();
  const sortByOption = [
    {
      id: 1,
      name: language["Popular Item"],
      slug: "popular_item",
    },
    {
      id: 2,
      name: language["Trending Item"],
      slug: "trending_item",
    },
    {
      id: 3,
      name: language["Featured Item"],
      slug: "featured_item",
    },
  ];
  const [selectedSort, setSelectedSort] = useState(null);
  //   dynamic states
  const sortingHandler = (value) => {
    setSelectedSort(value);
  };

  const [page, setPage] = useState(1);
  const { data, isFetching } = useShopPageInfoQuery({
    page: page,
    ratings: ratings,
    priceRange: volume,
    category: categorySlug,
    currencyRate: 1,
    sortby: selectedSort,
    searchKey: searchKey || null,
  });
  const [shopPageInfoQuery] = useLazyShopPageInfoQuery();
  const [paginateLoader, setPaginateLoader] = useState(false);
  const searchHandler = () => {
    setPage(1);
    if (page === 1) {
      shopPageInfoQuery({
        page: 1,
        ratings: ratings,
        priceRange: volume,
        category: categorySlug,
        currencyRate: 1,
        sortby: selectedSort,
        searchKey: searchKey || null,
      });
    } else {
      setPage(1);
    }
    setPaginateLoader(false);
  };
  const paginationHandler = () => {
    setPaginateLoader(true);
    setPage((prev) => prev + 1);
  };
  useEffect(() => {
    if (!isFetching) {
      setPaginateLoader(false);
    }
  }, [isFetching]);

  return (
    <div className="w-full">
      <div className="theme-container mx-auto">
        <div className="w-full">
          <div className="w-full lg:flex lg:rtl:space-x-reverse space-x-[30px]">
            <div className="lg:w-[270px] w-full">
              <Sidebar
                sideBarAction={{ filterToogle, handler: setFilterToogle }}
                priceRange={{ volume, handler: volumeHandler }}
                max_price={max_price}
                category={{ categories }}
                rating={{ ratings, handler: ratingHandler }}
                search={categorySlug}
                resetfilter={reset}
                searchAction={searchHandler}
                ads={settings?.shoppage_ads}
              />
            </div>
            <div className="flex-1">
              <div className="flex justify-end mb-8">
                <div className="flex rtl:space-x-reverse space-x-5">
                  <button
                    onClick={() => setFilterToogle(true)}
                    type="button"
                    className="lg:hidden block"
                  >
                    <div className="defaultBox flex rtl:space-x-reverse space-x-7 items-center rounded py-2.5 px-[14px]">
                      <span className="text-sm leading-[21px] text-white">
                        <StringLang string="Filters" />
                      </span>
                      <span>
                        <span>
                          <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M4 13V12C4 9.23858 6.23858 7 9 7H20L17 4"
                              stroke="#28303F"
                              strokeWidth="1.5"
                              strokeLinecap="round"
                              strokeLinejoin="round"
                            ></path>
                            <path
                              d="M20 11V12C20 14.7614 17.7614 17 15 17H4L7 20"
                              stroke="#28303F"
                              strokeWidth="1.5"
                              strokeLinecap="round"
                              strokeLinejoin="round"
                            ></path>
                          </svg>
                        </span>
                      </span>
                    </div>
                  </button>
                  <div className="flex rtl:space-x-reverse space-x-3 items-center">
                    <span className="text-base leading-6 text-white sm:block hidden">
                      <StringLang string="Sort By" />:
                    </span>
                    <DropDown action={sortingHandler} datas={sortByOption}>
                      {({ item }) => (
                        <div className="defaultBox flex rtl:space-x-reverse space-x-7 items-center rounded py-2.5 px-[14px]">
                          <span className="text-sm leading-[21px] text-white">
                            {item?.name}
                          </span>
                          <span>
                            <svg
                              width="14"
                              height="9"
                              viewBox="0 0 14 9"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M13.7108 1.17367C13.6178 1.07903 13.5072 1.00391 13.3854 0.952653C13.2635 0.901392 13.1328 0.875 13.0008 0.875C12.8688 0.875 12.7381 0.901392 12.6162 0.952653C12.4944 1.00391 12.3838 1.07903 12.2908 1.17367L7.71079 5.79814C7.61783 5.89277 7.50723 5.96789 7.38537 6.01915C7.26351 6.07041 7.1328 6.09681 7.00079 6.09681C6.86878 6.09681 6.73807 6.07041 6.61622 6.01915C6.49436 5.96789 6.38376 5.89277 6.29079 5.79814L1.71079 1.17367C1.61783 1.07903 1.50723 1.00391 1.38537 0.952653C1.26351 0.901392 1.1328 0.875 1.00079 0.875C0.868781 0.875 0.738075 0.901392 0.616216 0.952653C0.494356 1.00391 0.383755 1.07903 0.290792 1.17367C0.104542 1.36285 0 1.61876 0 1.88551C0 2.15227 0.104542 2.40818 0.290792 2.59736L4.88079 7.23192C5.44329 7.79918 6.20579 8.1178 7.00079 8.1178C7.79579 8.1178 8.55829 7.79918 9.12079 7.23192L13.7108 2.59736C13.897 2.40818 14.0016 2.15227 14.0016 1.88551C14.0016 1.61876 13.897 1.36285 13.7108 1.17367Z"
                                fill="#606C7D"
                              />
                            </svg>
                          </span>
                        </div>
                      )}
                    </DropDown>
                  </div>
                </div>
              </div>
              {data?.products?.data?.length > 0 ? (
                <div className="w-full">
                  <PaginateObserver
                    type="onclick"
                    handler={paginationHandler}
                    currentPage={page}
                    lastPage={data?.products?.last_page}
                    loading={paginateLoader}
                  >
                    <div className="grid xl:grid-cols-3 grid-cols-2  sm:gap-6 gap-3 mb-[30px]">
                      {data?.products?.data.map((item, i) => {
                        if (parseInt(item.status) === 1) {
                          return (
                            <ProductCard
                              className="bg-black"
                              {...item}
                              key={i}
                            />
                          );
                        }
                      })}
                    </div>
                  </PaginateObserver>
                </div>
              ) : !isFetching ? (
                <NoResultFound />
              ) : (
                <div className="flex justify-center mt-10">
                  <SvgLoader />
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Index;
