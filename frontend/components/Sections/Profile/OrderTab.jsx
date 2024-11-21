"use client";
import React, { useState } from "react";
import Modal from "@/components/Helper/Modal";
import {
  useApproveOrderMutation,
  useGetOrderQuery,
} from "@/store/features/order/apiSlice";
import PaginateObserver from "@/components/Helper/PaginateObserver";
import { useDispatch, useSelector } from "react-redux";
import { ordersPageIncrease } from "@/store/features/pagination/paginationSlice";
import ReviewModal from "@/components/Helper/ReviewModal";
import OrderChatBoard from "@/components/Helper/OrderChatBoard";
import StringLang from "@/utilities/StringLang";
import useCurrency from "@/hooks/useCurrency";

function OrderTab() {
  const [toogleModal, setToogleModal] = useState(false);
  const [orderViewType, setOrderViewType] = useState("list");
  const page = useSelector((state) => state?.pagination?.ordersPage);
  const dispatch = useDispatch();
  const { data, isFetching } = useGetOrderQuery({ page });
  const paginationHandler = () => {
    dispatch(ordersPageIncrease());
  };

  const [approveOrder, { isLoading }] = useApproveOrderMutation();
  const calculatePrice = useCurrency();
  return (
    <div className="w-full md:px-10 md:py-7 p-5 bg-black rounded-md">
      {orderViewType === "list" && (
        <div className="w-full">
          <p className="text-[24px] font-semibold text-white leading-8 mb-[18px]">
            <StringLang string="My Order" />
          </p>

          <PaginateObserver
            type="onclick"
            handler={paginationHandler}
            currentPage={page}
            lastPage={data?.items?.last_page}
            loading={isFetching}
          >
            <div className="flex flex-col space-y-[18px] ">
              {data?.items?.data.map((item, i) => {
                return (
                  <div
                    key={item.id}
                    style={{
                      boxShadow: "0px 6px 60px 5px rgba(0, 0, 0, 0.08)",
                    }}
                    className="w-full group rounded overflow-hidden  p-2.5  border border-[#3C3E42] bg-[#0B0E12]"
                  >
                    <div className="grid md:grid-cols-2 grid-cols-1 gap-5 md:gap-0 md:items-center">
                      <div className="w-full flex md:flex-row flex-col md:rtl:space-x-reverse space-x-4 space-y-4 md:space-y-0 md:items-center ">
                        <div className="md:w-[160px] w-full h-[130px] relative rounded overflow-hidden">
                          <img
                            src={process.env.BASE_URL + item.variant_image}
                            alt=""
                            className=" w-full h-full object-cover transform scale-100 group-hover:scale-105 common-transition"
                          />
                        </div>
                        <div className="flex-1">
                          <div className="w-full md:pr-[14px]">
                            {/*price*/}
                            <div className="flex rtl:space-x-reverse space-x-2.5 items-center mb-1.5">
                              <span className="text-lg leading-5 font-semibold text-primary-blue notranslate">
                                {calculatePrice(Number(item?.option_price))}
                              </span>
                            </div>
                            <h1 className="text-[22px] text-white leading-[26px] font-medium line-clamp-1 mb-1 notranslate">
                              {item?.variant_name}
                            </h1>
                            <p className="text-primary-blue text-base notranslate">
                              #{item?.order_id}
                            </p>
                          </div>
                        </div>
                      </div>
                      <div className="w-full flex md:justify-end">
                        <div>
                          <div className="flex rtl:space-x-reverse space-x-2.5 items-center">
                            {item?.has_review === "no" &&
                            item?.approve_by_user == "approved" ? (
                              <button
                                onClick={() => setToogleModal(item.id)}
                                type="button"
                              >
                                <div className="lg:px-7 lg:py-4 px-5 py-3 border border-primary-blue flex justify-center items-center rounded overflow-hidden">
                                  <span className="text-lg font-semibold text-white">
                                    Review
                                  </span>
                                </div>
                              </button>
                            ) : (
                              " "
                            )}

                            <button
                              onClick={() => setOrderViewType(item)}
                              type="button"
                            >
                              <div className="lg:px-7 lg:py-4 px-5 py-3 bg-primary-blue flex justify-center items-center rounded overflow-hidden">
                                <span className="text-lg font-semibold text-primary-black">
                                  <StringLang string="Get Info" />
                                </span>
                              </div>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                );
              })}

              {data?.items?.data?.length > 0 && !isFetching ? <div></div> : ""}
            </div>
          </PaginateObserver>
        </div>
      )}
      {orderViewType !== "list" && orderViewType?.id && (
        <>
          <div className="w-full mb-[18px] flex rtl:space-x-reverse space-x-2.5 items-center">
            <button onClick={() => setOrderViewType("list")} type="button">
              <svg
                width="34"
                height="34"
                viewBox="0 0 34 34"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                className="rtl:rotate-180"
              >
                <circle cx="17" cy="17" r="17" fill="#E7F0FD" />
                <g clipPath="url(#clip0_5833_4704)">
                  <path
                    d="M10.0798 16.8937C9.74944 17.224 9.74944 17.776 10.0798 18.1072L17.7021 25.7491C18.0367 26.0836 18.5793 26.0836 18.9131 25.7491C19.2477 25.4145 19.2477 24.871 18.9131 24.5364L11.8962 17.5L18.9139 10.4645C19.2485 10.1291 19.2485 9.58644 18.9139 9.25101C18.5793 8.91643 18.0367 8.91643 17.703 9.25101L10.0798 16.8937Z"
                    fill="#0E6DE8"
                  />
                </g>
                <defs>
                  <clipPath id="clip0_5833_4704">
                    <rect
                      width="17"
                      height="17"
                      fill="white"
                      transform="translate(6 26) rotate(-90)"
                    />
                  </clipPath>
                </defs>
              </svg>
            </button>
            <p className="text-[24px] font-semibold text-white leading-8 ">
              <StringLang string="Order Message" />
            </p>
          </div>
          <div className="w-full flex xl:flex-row flex-col-reverse xl:rtl:space-x-reverse space-x-[30px]">
            <div className="flex-1">
              <div className="flex flex-col space-y-[20px]">
                <OrderChatBoard
                  id={orderViewType?.id}
                  isApprove={orderViewType?.approve_by_user === "approved"}
                />
              </div>
            </div>
            <div className="xl:w-[260px] w-full xl:border-l border-[#23262B] mb-5 xl:mb-0">
              <div className="xl:ml-5">
                <div className="product-col-item w-full group rounded overflow-hidden ">
                  <div className="w-full flex flex-col space-y-4   ">
                    <div>
                      <p className="text-base font-semibold text-white leading-8 ">
                        <StringLang string="Order Info" />
                      </p>
                      <div className="w-full h-[170px] relative  rounded-lg overflow-hidden">
                        <img
                          src={
                            process.env.BASE_URL + orderViewType.variant_image
                          }
                          alt=""
                          className=" w-full h-full  object-cover transform scale-100 group-hover:scale-105 common-transition"
                        />
                      </div>
                    </div>
                    <div className="flex-1">
                      <div className="w-full ">
                        {/*price*/}
                        <div className="flex rtl:space-x-reverse space-x-2.5 items-center mb-1.5">
                          <span className="text-lg leading-5 font-semibold text-primary-blue notranslate">
                            {calculatePrice(
                              Number(orderViewType?.option_price)
                            )}
                          </span>
                        </div>
                        <h1 className="text-[22px] text-white leading-[26px] font-medium line-clamp-1 mb-1">
                          {orderViewType?.option_name}
                        </h1>
                        <p className="text-white text-sm mb-[26px]">
                          Order ID: #{orderViewType?.order_id}
                        </p>
                        <div className="w-full h-10 flex justify-center items-center rounded  border border-primary-blue">
                          <span className="text-white text-base font-semibold">
                            Purchased
                          </span>
                        </div>
                        {orderViewType?.approve_by_user !== "approved" && (
                          <button
                            disabled={isLoading}
                            onClick={() => {
                              approveOrder({
                                orderId: orderViewType.id,
                                reSet: () => {
                                  setOrderViewType("list");
                                },
                              });
                            }}
                            className="py-4 px-8 w-full flex rtl:space-x-reverse space-x-2.5 justify-center items-center bg-primary-blue  hover:bg-white hover:text-black   group common-transition rounded-[5px] mt-5 cursor-pointer"
                          >
                            <span className="text-primary-black  common-transition group-hover:text-black text-base font-medium leading-5 text-center">
                              Approve Order
                            </span>
                          </button>
                        )}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </>
      )}
      {toogleModal && (
        <Modal onClose={() => setToogleModal(false)}>
          <div className="w-full h-screen fixed left-0 top-0  flex justify-center items-center">
            <div
              onClick={() => setToogleModal(false)}
              className="w-full h-full fixed left-0 top-0 bg-black bg-opacity-50"
            ></div>
            <ReviewModal
              orderId={toogleModal}
              close={() => setToogleModal(false)}
            />
          </div>
        </Modal>
      )}
    </div>
  );
}

export default OrderTab;
