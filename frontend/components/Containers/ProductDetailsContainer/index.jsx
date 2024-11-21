"use client";
import React, { useState } from "react";
import SwiperSliderCom from "@/components/Helper/SwiperSliderCom";
import RecommendedProduct from "@/components/Sections/Homepage/RecommendedProduct";
import Modal from "@/components/Helper/Modal";
import Link from "next/link";
import MiniSvgLoader from "@/components/Helper/Loader/SvgLoader";
import { useReviewListQuery } from "@/store/features/reviews/apiSlice";
import ReactTimeAgo from "react-time-ago";
import PaginateObserver from "@/components/Helper/PaginateObserver";
import { useAddCartMutation } from "@/store/features/cart/apiSlice";
import useCurrency from "@/hooks/useCurrency";
import { useRouter } from "next/navigation";
import { useCheckOutMutation } from "@/store/features/order/apiSlice";
const initialState = { account_id: "", message: "" };

import StringLang from "@/utilities/StringLang";
import {
  useBankTransferMutation,
  usePaymentInfoQuery,
} from "@/store/features/payment/apiSlice";
import { useSelector } from "react-redux";
import BankPayment from "@/components/Common/BankPayment";
import DateFormat from "@/utilities/DateFormat";

function OrderCom({ closeHandler, product }) {
  const [qty, setQty] = useState(1);
  const [bankPay, setBankPay] = useState(false);
  const [formData, setFormData] = useState(initialState);
  const [paymentMethod, setPaymentMethod] = useState(false);
  const token = useSelector((state) => state.auth.accessToken);
  const { data: paymentInfo } = usePaymentInfoQuery();
  // const [checkOut, { isLoading: loadingCheckout }] = useCheckOutMutation();
  const [addCart, { isLoading }] = useAddCartMutation();
  const [bankTransfer] = useBankTransferMutation();
  const quantityHandler = (type) => {
    if (type === "increase") {
      setQty((prev) => prev + 1);
    } else {
      if (qty >= 1) {
        if (qty > 1) {
          setQty((prev) => prev - 1);
        }
      }
    }
  };
  const data = {
    product_id: product?.service?.product_id,
    variant_id: product?.service?.id,
    variant_name: product?.service?.variant_name,
    option_name: product?.option?.title,
    option_price: product?.option?.price,
    qty: qty,
    variant_image: product?.service?.file_name,
    message: formData.message,
    account_id: formData.account_id,
  };

  const currency = useCurrency();
  const router = useRouter();
  const redirectToOrder = () => {
    router.push("/auth/profile/order");
  };

  const handleInput = (e) => {
    setFormData((prev) => ({
      ...prev,
      [e.target.getAttribute("name")]: e.target.value,
    }));
  };

  handleInput.bind(this);
  console.log(paymentInfo);

  return (
    <div
      data-aos="fade-up"
      className="w-[771px] bg-black rounded-[5px] p-[30px] relative"
    >
      <div className="flex justify-between items-center mb-7">
        <p className="text-[24px] font-semibold text-white leading-8 text-center">
          <StringLang string="Easy way to Buy" />
        </p>
        <button
          onClick={closeHandler}
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
      <div className="grid grid-cols-2 gap-8 mb-5">
        <div className="col-span-full w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              User ID(only game)
            </label>
            <input
              type="text"
              name="account_id"
              value={formData.account_id}
              onChange={handleInput}
              placeholder="Name"
              className="w-full h-full text-white  rounded-[5px] bg-[#0B0E12] border border-[#23262B]  px-4 focus:outline-none"
            />
          </div>
        </div>
        <div className="col-span-full w-full">
          <div className="input-field relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center">
              Message to Seller
            </label>
            <textarea
              placeholder="Write a Comment"
              name="message"
              value={formData.message}
              onChange={handleInput}
              className="w-full h-[84px] text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B] p-4 focus:outline-none resize-none"
            ></textarea>
          </div>
        </div>
      </div>
      <div className="lg:flex justify-between items-center mb-[30px]">
        {/*quantity*/}
        <div className="quantity-wrapper lg:mb-0 mb-5">
          <p className="text-base text-white leading-[24px] mb-2">Quantity</p>
          <div className="py-[14px] px-[32px] rounded grid grid-cols-3 gap-6 place-items-center border bg-[#0B0E12] border-[#202126]">
            <button
              onClick={() => quantityHandler("decrease")}
              type="button"
              id="decrese"
              className="text-gray focus:text-primary-blue text-2xl"
            >
              -
            </button>
            <span className="text-lg text-white font-bold block w-5">
              {qty}
            </span>
            <button
              onClick={() => quantityHandler("increase")}
              type="button"
              id="decrese"
              className="text-gray focus:text-primary-blue text-2xl"
            >
              +
            </button>
          </div>
        </div>
        <div className="pricing-action">
          <div className="flex justify-end">
            <div className="flex rtl:space-x-reverse space-x-3 items-center">
              <p className="text-[30px] font-bold text-[#EB5757] leading-9 text-end">
                {currency(product?.option?.price)}
              </p>
            </div>
          </div>

          <div className="flex rtl:space-x-reverse space-x-2.5 items-center justify-end">
            <button
              disabled={isLoading}
              onClick={() => addCart({ product: data, closeHandler })}
              type="button"
            >
              <div className="px-7 py-4 border border-primary-blue flex justify-center items-center rounded overflow-hidden">
                <span className="text-lg font-semibold text-primary-blue">
                  <StringLang string="Add to cart" />
                </span>
              </div>
            </button>
            <button
              disabled={isLoading}
              onClick={() => {
                addCart({
                  product: data,
                  item_type: "buy_now",
                  activePayment: () => setPaymentMethod(true),
                });
              }}
              type="button"
            >
              <div className="px-7 py-4 bg-primary-blue flex justify-center items-center rounded overflow-hidden">
                <span className="text-lg font-semibold text-primary-black">
                  <StringLang string="Buy Now" />
                </span>
              </div>
            </button>
          </div>
        </div>
      </div>
      {paymentMethod ? (
        <div className="w-full px-[30px] py-10 border-primary-border-secondary  rounded-[5px]">
          <p className="text-xl font-bold text-whiteleading-8 mb-5">
            Payment Method
          </p>
          <div className="grid lg:grid-cols-6 grid-cols-3 gap-[13px]">
            {/* <button
              disabled={loadingCheckout}
              onClick={() =>
                checkOut({
                  redirectToOrder,
                  order_type: "buy_now",
                })
              }
              className="item h-[63px] bg-[#EEF5FF] p-3 border border-primary-border-secondary rounded cursor-pointer"
            >
              <img
                src="/assets/img/cash-on-delivery.png"
                alt=""
                className="w-full h-full object-contain"
              />
            </button> */}
            {/* paypal  */}
            {Number(paymentInfo?.paypal?.status) === 1 && (
              <a
                href={
                  process.env.BASE_URL +
                  "payment-api/paypal-webview?token=" +
                  token +
                  "&lang_code=" +
                  "en" +
                  "&message=" +
                  formData.message +
                  "&account_id=" +
                  formData.account_id
                }
                className="item h-[63px] bg-[#EEF5FF] p-3 border border-primary-border-secondary rounded"
              >
                <img
                  src={process.env.BASE_URL + paymentInfo?.paypal?.image}
                  alt=""
                  className="w-full h-full object-contain"
                />
              </a>
            )}

            {/* stripe  */}
            {Number(paymentInfo?.stripe?.status) === 1 && (
              <a
                href={
                  process.env.BASE_URL +
                  "payment-api/pay-with-stripe?token=" +
                  token +
                  "&lang_code=" +
                  "en" +
                  "&message=" +
                  formData.message +
                  "&account_id=" +
                  formData.account_id
                }
                className="item h-[63px] bg-[#EEF5FF] p-3 border border-primary-border-secondary rounded"
              >
                <img
                  src={process.env.BASE_URL + paymentInfo?.stripe?.image}
                  alt=""
                  className="w-full h-full object-contain"
                />
              </a>
            )}

            {/* razorpay  */}
            {Number(paymentInfo?.razorpay?.status) === 1 && (
              <a
                href={
                  process.env.BASE_URL +
                  "payment-api/razorpay-webview?token=" +
                  token +
                  "&lang_code=" +
                  "en" +
                  "&message=" +
                  formData.message +
                  "&account_id=" +
                  formData.account_id
                }
                className="item h-[63px] bg-[#EEF5FF] p-3 border border-primary-border-secondary rounded"
              >
                <img
                  src={process.env.BASE_URL + paymentInfo?.razorpay?.image}
                  alt=""
                  className="w-full h-full object-contain"
                />
              </a>
            )}

            {/* paystack  */}
            {Number(paymentInfo?.paystack?.paystack_status) === 1 && (
              <a
                href={
                  process.env.BASE_URL +
                  "payment-api/paystack-webview?token=" +
                  token +
                  "&lang_code=" +
                  "en" +
                  "&message=" +
                  formData.message +
                  "&account_id=" +
                  formData.account_id
                }
                className="item h-[63px] bg-[#EEF5FF] p-3 border border-primary-border-secondary rounded"
              >
                <img
                  src={
                    process.env.BASE_URL + paymentInfo?.paystack?.paystack_image
                  }
                  alt=""
                  className="w-full h-full object-contain"
                />
              </a>
            )}

            {/* mollie  */}
            {Number(paymentInfo?.mollie?.mollie_status) === 1 && (
              <a
                href={
                  process.env.BASE_URL +
                  "payment-api/mollie-webview?token=" +
                  token +
                  "&lang_code=" +
                  "en" +
                  "&message=" +
                  formData.message +
                  "&account_id=" +
                  formData.account_id
                }
                className="item h-[63px] bg-[#EEF5FF] p-3 border border-primary-border-secondary rounded"
              >
                <img
                  src={process.env.BASE_URL + paymentInfo?.mollie?.mollie_image}
                  alt=""
                  className="w-full h-full object-contain"
                />
              </a>
            )}

            {/* instamojo  */}
            {Number(paymentInfo?.instamojo?.status) === 1 && (
              <a
                href={
                  process.env.BASE_URL +
                  "payment-api/instamojo-webview?token=" +
                  token +
                  "&lang_code=" +
                  "en" +
                  "&message=" +
                  formData.message +
                  "&account_id=" +
                  formData.account_id
                }
                className="item h-[63px] bg-[#EEF5FF] p-3 border border-primary-border-secondary rounded"
              >
                <img
                  src={process.env.BASE_URL + paymentInfo?.instamojo?.image}
                  alt=""
                  className="w-full h-full object-contain"
                />
              </a>
            )}

            {/* flutterwave  */}
            {Number(paymentInfo?.flutterwave?.status) === 1 && (
              <a
                href={
                  process.env.BASE_URL +
                  "payment-api/flutterwave-webview?token=" +
                  token +
                  "&lang_code=" +
                  "en" +
                  "&message=" +
                  formData.message +
                  "&account_id=" +
                  formData.account_id
                }
                className="item h-[63px] bg-[#EEF5FF] p-3 border border-primary-border-secondary rounded"
              >
                <img
                  src={process.env.BASE_URL + paymentInfo?.flutterwave?.logo}
                  alt=""
                  className="w-full h-full object-contain"
                />
              </a>
            )}

            {Number(paymentInfo?.bankPayment?.status) === 1 && (
              <button
                onClick={() => {
                  setBankPay(true);
                  setPaymentMethod(false);
                }}
                className="item h-[63px] bg-[#EEF5FF] p-3 border border-primary-border-secondary rounded"
              >
                <img
                  src={process.env.BASE_URL + paymentInfo?.bankPayment?.image}
                  alt=""
                  className="w-full h-full object-contain"
                />
              </button>
            )}
          </div>
        </div>
      ) : (
        ""
      )}
      {bankPay && (
        <BankPayment
          paymentInfo={paymentInfo?.bankPayment?.account_info}
          submitAction={(tnxId) => {
            setBankPay(false);
            bankTransfer({ formInfo: { ...formData, tnx_info: tnxId } });
          }}
        />
      )}
    </div>
  );
}

function Reviews({ pid }) {
  const [page, setPage] = useState(1);
  const { data, isFetching } = useReviewListQuery({ id: pid, page: page });
  const timeAgoHandler = (time) => {
    return new Date(time).getTime();
  };
  if (data && data?.reviews?.data) {
    return (
      <div className="mt-10">
        <h2 className="text-2xl font-bold text-white mb-2">
          <StringLang string="Review" />
        </h2>
        <div className="flex rtl:space-x-reverse space-x-1 items-center mb-5">
          <span>
            <svg
              width="22"
              height="20"
              viewBox="0 0 22 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M11.0298 0L13.5062 7.60081H21.5198L15.0366 12.2984L17.513 19.8992L11.0298 15.2016L4.54665 19.8992L7.023 12.2984L0.539837 7.60081H8.55346L11.0298 0Z"
                fill="#FFB321"
              />
            </svg>
          </span>
          <span className="text-lg font-medium">
            <span className="text-white">({data?.reviews?.total} Ratings)</span>
          </span>
        </div>
        <PaginateObserver
          currentPage={page}
          loading={isFetching}
          lastPage={data?.reviews?.last_page}
          handler={() => setPage((prev) => prev + 1)}
          type="onclick"
        >
          <div className="grid md:grid-cols-2 grid-cols-1 lg:gap-[30px] gap-5 mb-[30px]">
            {data?.reviews?.data.length > 0 &&
              data?.reviews?.data.map((review, i) => (
                <div
                  key={i}
                  style={{
                    boxShadow: "0px 6px 60px 5px rgba(0, 0, 0, 0.08)",
                  }}
                  className="item w-full rounded-[5px] border border-primary-border-secondary flex flex-col justify-between"
                >
                  <div className="p-5 flex h-[130px] flex-col space-y-3">
                    <div className="flex rtl:space-x-reverse space-x-2 items-center mb-3">
                      {Array.from(Array(parseInt(review.rating)), () => (
                        <span
                          key={Math.random()}
                          className="text-primary-yellow"
                        >
                          <svg
                            width="21"
                            height="20"
                            viewBox="0 0 21 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            className="fill-current"
                          >
                            <path d="M10.0271 0L12.2783 6.90983H19.5634L13.6697 11.1803L15.9209 18.0902L10.0271 13.8197L4.13332 18.0902L6.38454 11.1803L0.490761 6.90983H7.77588L10.0271 0Z" />
                          </svg>
                        </span>
                      ))}
                      {parseInt(review.rating) < 5 && (
                        <>
                          {Array.from(
                            Array(5 - parseInt(review.rating)),
                            () => (
                              <span
                                key={Math.random()}
                                className="text-gray-400"
                              >
                                <svg
                                  width="21"
                                  height="20"
                                  viewBox="0 0 21 20"
                                  fill="none"
                                  xmlns="http://www.w3.org/2000/svg"
                                  className="fill-current"
                                >
                                  <path d="M10.0271 0L12.2783 6.90983H19.5634L13.6697 11.1803L15.9209 18.0902L10.0271 13.8197L4.13332 18.0902L6.38454 11.1803L0.490761 6.90983H7.77588L10.0271 0Z" />
                                </svg>
                              </span>
                            )
                          )}
                        </>
                      )}
                    </div>
                    <p className="text-base font-medium text-white line-clamp-3">
                      {review.review}
                    </p>
                  </div>
                  <div className="px-5 py-3 border-t border-primary-border-secondary flex rtl:space-x-reverse space-x-2.5">
                    <div className="w-[38px] h-[38px] rounded-full overflow-hidden">
                      <img
                        src={process.env.BASE_URL + review?.user.image}
                        alt=""
                        className="w-full h-full object-cover"
                      />
                    </div>
                    <div>
                      <p className="text-base font-semibold text-white notranslate">
                        {review?.user.name}
                      </p>
                      <p className="text-sm">
                        <ReactTimeAgo
                          date={timeAgoHandler(new Date(review.created_at))}
                          locale="en-US"
                        />
                      </p>
                    </div>
                  </div>
                </div>
              ))}
          </div>
        </PaginateObserver>
      </div>
    );
  } else if (!isFetching) {
    return (
      <p className="text-center text-primary-blue text-sm font-medium mt-10 ">
        <StringLang string="No Review Found!" />
      </p>
    );
  } else {
    return (
      <div className="flex justify-center mt-10">
        <MiniSvgLoader />
      </div>
    );
  }
}

function Index({ datas }) {
  const { settings } = useSelector((state) => state.defaultSettings);
  const [toggleModal, setToggleModal] = useState(false);
  const [selectedProduct, setSelectedProduct] = useState(null);
  const chooseProductHandler = (value) => {
    setSelectedProduct(value);
    setToggleModal(!toggleModal);
  };
  const [tabSelected, setTabSelected] = useState(
    datas.variant_of_services &&
      datas.variant_of_services.length > 0 &&
      datas.variant_of_services[0]
  );
  const options = {
    slidesPerView: "auto",
    spaceBetween: 20,
  };

  const currency = useCurrency();

  return (
    <>
      <div className="w-full pt-8">
        <div className="theme-container mx-auto">
          <div className="w-full flex xl:flex-row flex-col gap-[31px]">
            <div className="xl:w-[769px]">
              <div className="w-full">
                <div className="w-full lg:h-[507px] h-[400px] rounded-lg overflow-hidden mb-[18px]">
                  <img
                    src={process.env.BASE_URL + datas.product.thumbnail_image}
                    alt=""
                    className="w-full h-full object-cover"
                  />
                </div>
                <div className="w-full mb-5">
                  <h1 className="text-2xl font-bold text-white mb-3 notranslate">
                    {datas.product.name}
                  </h1>
                  <p className="text-base">{datas.product.short_description}</p>
                </div>
                {datas.variant_of_services &&
                  datas.variant_of_services.length > 0 && (
                    <div className="details-tab-wrapper w-full p-6 rounded-lg bg-black mb-10">
                      {/*tab button*/}
                      <div className="details-tag-wrapper w-full">
                        <SwiperSliderCom options={options}>
                          {datas.variant_of_services.map((service, i) => (
                            <div
                              key={i}
                              className="w-[142px] h-[175px] relative"
                            >
                              <div
                                onClick={() => setTabSelected(service)}
                                className={`w-full h-[157px] p-1 rounded-md  bg-[#0B0E12] cursor-pointer ${
                                  tabSelected.id === service.id
                                    ? "border-2 border-primary-blue"
                                    : "border border-[#23262B]"
                                }`}
                              >
                                <div className="w-full h-[123px] rounded overflow-hidden">
                                  <img
                                    src={
                                      process.env.BASE_URL + service.file_name
                                    }
                                    className="w-full h-full object-cover"
                                    alt=""
                                  />
                                </div>
                                <div className="px-1 py-[6px]">
                                  <p
                                    title={service.variant_name}
                                    className="text-sm font-medium text-white line-clamp-1 notranslate"
                                  >
                                    {service.variant_name}
                                  </p>
                                </div>
                              </div>
                              {tabSelected.id === service.id && (
                                <div className="w-full absolute left-0 bottom-0">
                                  <div className="w-full flex justify-center">
                                    <div className="border-t-[18px] border-primary-blue border-l-[18px] border-l-transparent border-r-[18px] border-r-transparent"></div>
                                  </div>
                                </div>
                              )}
                            </div>
                          ))}
                        </SwiperSliderCom>
                      </div>
                      {/*tab body  */}
                      {datas.variant_of_services.map((service, i) => (
                        <div
                          key={i}
                          className={`tab-body flex flex-col space-y-5 mt-3 ${
                            tabSelected.id === service.id ? "active" : ""
                          }`}
                        >
                          {service.service_options &&
                            service.service_options.length > 0 &&
                            service.service_options.map((option, j) => (
                              <div
                                key={j}
                                className="w-full bg-[#0B0E12] rounded-md border border-[#23262B] py-[15px] px-[18px] flex md:flex-row flex-col space-y-4 md:space-y-0 justify-between items-start md:items-center"
                              >
                                <div>
                                  <p className="text-lg font-semibold text-primary-blue mb-1.5">
                                    {option.title}
                                  </p>
                                  <p className="text-[22px] leading-[26px] text-white">
                                    <StringLang string="Start from" />{" "}
                                    <b>{currency(option.price)}</b>
                                  </p>
                                </div>
                                <button
                                  type="button"
                                  onClick={() =>
                                    chooseProductHandler({
                                      option,
                                      service,
                                    })
                                  }
                                >
                                  <div className="group lg:py-4 lg:px-[25px] py-3 px-5 flex rtl:space-x-reverse space-x-2.5 items-center bg-primary-blue group- hover:bg-white hover:text-black  common-transition rounded-[5px]">
                                    <span className="text-primary-black  common-transition group-hover:text-black text-base font-medium leading-5">
                                      <StringLang string="Order Now" />
                                    </span>
                                  </div>
                                </button>
                              </div>
                            ))}
                        </div>
                      ))}
                    </div>
                  )}

                {/*review*/}
                <Reviews pid={datas.product.id} />

                {/*product details*/}
                <h3 className="text-2xl font-bold text-white mb-4 mt-10">
                  <StringLang string="Products Details" />
                </h3>
                <div
                  className="pb-10 blog-details-html"
                  dangerouslySetInnerHTML={{
                    __html: datas.product.description,
                  }}
                ></div>
              </div>
            </div>
            <div className="flex-1">
              <div className="w-full px-[30px] py-[26px] bg-black rounded-lg mb-[30px]">
                <div className="w-full flex  flex-col space-y-5  items-center ">
                  <div>
                    <div className="flex justify-center">
                      <div className="w-[124px] h-[124px] rounded-full overflow-hidden mb-3 md:mb-0">
                        <img
                          src={process.env.BASE_URL + datas.author.image}
                          alt=""
                          className="w-full h-full object-cover"
                        />
                      </div>
                    </div>
                    <div>
                      <h1 className="text-white text-2xl font-bold text-center mt-4 notranslate">
                        {datas.author.name}
                      </h1>
                      <p className="text-[#E5E7EB] text-base font-medium text-center mt-4">
                        Joined - {DateFormat(datas.author.created_at)}
                      </p>
                      <div className="flex rtl:space-x-reverse space-x-1.5 items-center mt-2.5 justify-center ">
                        <div className="flex">
                          {Array.from(
                            Array(parseInt(datas.author.average_rating)),
                            () => (
                              <span
                                key={Math.random()}
                                className="text-[#FFB321]"
                              >
                                <svg
                                  width="21"
                                  height="20"
                                  viewBox="0 0 21 20"
                                  fill="none"
                                  xmlns="http://www.w3.org/2000/svg"
                                  className="fill-current"
                                >
                                  <path d="M10.0271 0L12.2783 6.90983H19.5634L13.6697 11.1803L15.9209 18.0902L10.0271 13.8197L4.13332 18.0902L6.38454 11.1803L0.490761 6.90983H7.77588L10.0271 0Z" />
                                </svg>
                              </span>
                            )
                          )}
                          {parseInt(datas.author.average_rating) < 5 && (
                            <>
                              {Array.from(
                                Array(
                                  5 - parseInt(datas.author.average_rating)
                                ),
                                () => (
                                  <span
                                    key={Math.random()}
                                    className="text-gray-400"
                                  >
                                    <svg
                                      width="21"
                                      height="20"
                                      viewBox="0 0 21 20"
                                      fill="none"
                                      xmlns="http://www.w3.org/2000/svg"
                                      className="fill-current"
                                    >
                                      <path d="M10.0271 0L12.2783 6.90983H19.5634L13.6697 11.1803L15.9209 18.0902L10.0271 13.8197L4.13332 18.0902L6.38454 11.1803L0.490761 6.90983H7.77588L10.0271 0Z" />
                                    </svg>
                                  </span>
                                )
                              )}
                            </>
                          )}
                        </div>
                        <span className="text-lg text-white font-semibold">
                          {datas.author.average_rating}
                        </span>
                      </div>
                    </div>
                  </div>
                  <Link
                    href={`/sellers/${datas.author.user_name}`}
                    className="w-full"
                  >
                    <div className="group w-full py-4 px-10 inline-flex rtl:space-x-reverse space-x-2.5 items-center bg-primary-blue justify-center group- hover:bg-white hover:text-black  common-transition rounded-[5px]">
                      <span className="text-primary-black  common-transition group-hover:text-black text-base font-medium leading-5">
                        <StringLang string="View Details" />
                      </span>
                    </div>
                  </Link>
                </div>
              </div>
              <div className="bg-black p-[30px] mb-[30px]">
                <div>
                  <p className="text-white text-xl leading-[24px] font-bold mb-5">
                    Why Chose us
                  </p>
                  <div>
                    <div className="inline-flex items-center rtl:space-x-reverse space-x-1 bg-primary-blue bg-opacity-10 px-3 py-2 rounded mb-5">
                      <img src="/assets/img/payment-success.png" alt="" />
                      <span className="text-base font-semibold text-white">
                        <StringLang string="Secure Payments" />
                      </span>
                    </div>
                    <div className="inline-flex items-center rtl:space-x-reverse space-x-1 bg-primary-blue bg-opacity-10 px-3 py-2 rounded">
                      <img src="/assets/img/hour-24.png" alt="" />
                      <span className="text-base font-semibold text-white">
                        <StringLang string="Support 24/7" />
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              {Number(settings?.shop_detail_ads?.status) === 1 && (
                <a
                  href={settings?.shop_detail_ads?.link}
                  target="_blank"
                  className="block w-full"
                >
                  <div className="w-full h-[520px]">
                    <img
                      src={
                        process.env.BASE_URL + settings?.shop_detail_ads?.image
                      }
                      alt=""
                      className="w-full h-full rounded-lg object-cover"
                    />
                  </div>
                </a>
              )}
            </div>
          </div>
        </div>
        <RecommendedProduct datas={datas.related_products} />
      </div>
      {toggleModal && (
        <Modal onClose={() => setToggleModal(false)}>
          <div className="w-full h-screen fixed left-0 top-0  flex justify-center items-center z-50">
            <div
              onClick={() => setToggleModal(false)}
              className="w-full h-full fixed left-0 top-0 bg-black bg-opacity-50"
            ></div>
            <OrderCom
              closeOld={() => setToggleModal(false)}
              product={selectedProduct}
              closeHandler={() => setToggleModal(false)}
            />
          </div>
        </Modal>
      )}
    </>
  );
}

export default Index;
