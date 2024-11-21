"use client";
import MiniSvgLoader from "@/components/Helper/Loader/SvgLoader";
import useCurrency from "@/hooks/useCurrency";
import { useGetCartQuery } from "@/store/features/cart/apiSlice";
import { useCheckOutMutation } from "@/store/features/order/apiSlice";
import Link from "next/link";
import { useRouter } from "next/navigation";
import React, { useState } from "react";
import StringLang from "@/utilities/StringLang";
import { useSelector } from "react-redux";
import {
  useBankTransferMutation,
  usePaymentInfoQuery,
} from "@/store/features/payment/apiSlice";
import Modal from "@/components/Helper/Modal";
import BankPayment from "@/components/Common/BankPayment";
const initialState = { account_id: "", message: "" };
function Index() {
  const { data, isFetching } = useGetCartQuery();
  const [formData, setFormData] = useState(initialState);
  // const [checkOut, { isLoading: loadingCheckout }] = useCheckOutMutation();
  const token = useSelector((state) => state.auth.accessToken);
  const [bankTransfer] = useBankTransferMutation();
  const { data: paymentInfo } = usePaymentInfoQuery();
  const router = useRouter();
  const [bankPay, setBankPay] = useState(false);
  const handleInput = (e) => {
    setFormData((prev) => ({
      ...prev,
      [e.target.getAttribute("name")]: e.target.value,
    }));
  };

  handleInput.bind(this);

  const redirectToOrder = () => {
    router.push("/auth/profile/order");
  };
  const currency = useCurrency();

  return (
    <div className="w-full py-[60px]">
      <div className="theme-container mx-auto">
        <div className="w-full lg:flex lg:rtl:space-x-reverse space-x-[30px]">
          <div className="flex-1 mb-6 lg:mb-0">
            <div className="w-full px-[30px] py-10 border-primary-border-secondary bg-black mb-[30px] rounded-[5px]">
              <p className="text-xl font-bold text-white leading-8 mb-5">
                <StringLang string="Contact Details" />
              </p>
              <div className="grid md:grid-cols-2 grid-cols-1 gap-5 ">
                <div className="col-span-full w-full">
                  <div className="input-field h-[50px] relative">
                    <label className="text-sm text-white bg-black bg-opacity-30 absolute left-3 w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center">
                      User ID*(only for game)
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
                    <label className="text-sm text-white bg-black bg-opacity-30 absolute left-3 w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center">
                      Message
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
            </div>

            <div className="w-full px-[30px] py-10 border-primary-border-secondary bg-black rounded-[5px]">
              <p className="text-xl font-bold text-white leading-8 mb-5">
                <StringLang string="Payment Method" />
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
                        process.env.BASE_URL +
                        paymentInfo?.paystack?.paystack_image
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
                      src={
                        process.env.BASE_URL + paymentInfo?.mollie?.mollie_image
                      }
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
                      src={
                        process.env.BASE_URL + paymentInfo?.flutterwave?.logo
                      }
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
                      src={
                        process.env.BASE_URL + paymentInfo?.bankPayment?.image
                      }
                      alt=""
                      className="w-full h-full object-contain"
                    />
                  </button>
                )}
              </div>
            </div>
          </div>
          <div className="lg:w-[371px] w-full ">
            <div
              style={{ boxShadow: "0px 6px 60px 5px rgba(0, 0, 0, 0.08)" }}
              className="w-full rounded-[5px] p-5 bg-black"
            >
              <div className="flex flex-col space-y-5 mb-8">
                {!data?.items && isFetching && (
                  <div className="w-full flex justify-center">
                    <MiniSvgLoader />
                  </div>
                )}
                {data?.items?.map((item) => (
                  <div
                    key={item.id}
                    className="flex rtl:space-x-reverse space-x-6 items-center pb-5 border-b border-primary-border-secondary/20"
                  >
                    <div className="w-[116px] h-[92px] overflow-hidden flex rounded-md justify-center items-center relative">
                      <img
                        src={process.env.BASE_URL + item.variant_image}
                        alt="product"
                        className="w-full h-full object-cover"
                      />
                    </div>
                    <div className="flex-1 flex flex-col">
                      <div className="mb-1.5">
                        <a href="#">
                          <p className="font-medium text-[20px] text-white  cursor-pointer line-clamp-1 notranslate">
                            {item.variant_name}
                          </p>
                        </a>
                      </div>
                      <p className="text-lg font-semibold text-primary-blue">
                        {currency(Number(item.option_price))}
                      </p>
                      <p className="text-lg text-primary-gray">
                        {item.qty} x <StringLang string="Item" />
                      </p>
                    </div>
                  </div>
                ))}
              </div>
              <div className="w-full">
                <div className="sub-total mb-6">
                  <div className="mb-6">
                    <div className=" flex justify-between mb-6">
                      <p className="text-lg font-medium text-white">
                        <StringLang string="Subtotal" />
                      </p>
                      <p className="text-lg font-medium text-qred notranslate">
                        {" "}
                        {currency(
                          data?.items?.reduce((total, item) => {
                            return (
                              Number(item?.option_price || 0) *
                                Number(item.qty) +
                              total
                            );
                          }, 0)
                        )}{" "}
                      </p>
                    </div>
                    <div className=" flex justify-between ">
                      <p className="text-lg font-medium text-white">
                        <StringLang string="Discount" />
                      </p>
                      <p className="text-lg font-medium text-primary-blue notranslate">
                        (-){" "}
                        {currency(
                          data?.items?.reduce((total, item) => {
                            return (
                              Number(item?.discount || 0) * Number(item.qty) +
                              total
                            );
                          }, 0)
                        )}
                      </p>
                    </div>
                  </div>
                  <div className="w-full h-[1px] bg-[#EDEDED]/20"></div>
                </div>
                <div className="total mb-6">
                  <div className=" flex justify-between">
                    <p className="text-[18px] font-medium text-white">
                      <StringLang string="Total" />
                    </p>
                    <p className="text-[18px] font-medium text-white">
                      {currency(
                        data?.items?.reduce((total, item) => {
                          return (
                            Number(item?.option_price || 0) * Number(item.qty) +
                            total
                          );
                        }, 0) -
                          data?.items?.reduce((total, item) => {
                            return (
                              Number(item?.discount || 0) * Number(item.qty) +
                              total
                            );
                          }, 0)
                      )}
                    </p>
                  </div>
                </div>
                <div className="w-full mb-3">
                  <Link href="/products" className="w-full">
                    <div className=" h-[54px] bg-[#FFB321] text-black flex justify-center items-center rounded-[5px] w-full">
                      <span className="text-lg font-semibold">
                        Return to Shopping
                      </span>
                    </div>
                  </Link>
                </div>
                <p className="text-center text-primary-gray">
                  <StringLang string="By clicking on the button you agree to the" />{" "}
                  <a href="#" className="text-primary-blue">
                    <StringLang string="Privacy Policy" />
                  </a>{" "}
                  <StringLang string="and" />{" "}
                  <a href="#" className="text-primary-blue">
                    <StringLang string="Terms and Conditions" />
                  </a>
                  .
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      {bankPay && (
        <Modal onClose={() => setBankPay(false)}>
          <div className="w-full h-screen fixed left-0 top-0  flex justify-center items-center">
            <div
              onClick={() => setBankPay(false)}
              className="w-full h-full fixed left-0 top-0 bg-black bg-opacity-50"
            ></div>
            <div
              data-aos="fade-up"
              className="w-[771px] bg-black rounded-[5px] p-[30px]"
            >
              <div className="flex justify-between items-center mb-7">
                <p className="text-[24px] font-semibold text-white leading-8 text-center">
                  <StringLang string="Bank Payment" />
                </p>
                <button
                  onClick={() => setBankPay(false)}
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
              <BankPayment
                paymentInfo={paymentInfo?.bankPayment?.account_info}
                submitAction={(tnxId) => {
                  setBankPay(false);
                  bankTransfer({ formInfo: { ...formData, tnx_info: tnxId } });
                }}
              />
            </div>
          </div>
        </Modal>
      )}
    </div>
  );
}

export default Index;
