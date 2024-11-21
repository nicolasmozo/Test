"use client";
import SwiperSliderCom from "@/components/Helper/SwiperSliderCom";
import React from "react";
import { red } from "next/dist/lib/picocolors";
import StringLang from "@/utilities/StringLang";

function TestimonialSlider({ datas }) {
  const options = {
    slidesPerView: 1,
    spaceBetween: 16,
    speed: 1000,
    autoplay: {
      delay: 3000,
    },
    breakpoints: {
      425: {
        slidesPerView: 1,
        spaceBetween: 16,
      },
      640: {
        slidesPerView: 2,
        spaceBetween: 16,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 16,
      },
      1210: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
  };
  if (datas && datas.length > 0) {
    return (
      <div className="w-full">
        <div className="w-full flex justify-center mb-[30px]">
          <div>
            <p className="text-xl text-primary-blue mb-2.5 text-center">
              <StringLang string="Testimonial" />
            </p>
            <h2 className="text-[24px] font-bold leading-[34px] text-white mb-3.5 text-center">
              <StringLang string="What Our Client Feedback" />
            </h2>
          </div>
        </div>
        <SwiperSliderCom options={options} dotsLabel="testimonial-dots">
          {datas.map((item, i) => (
            <div
              key={i}
              className="item w-full rounded-[5px] border border-primary-border bg-black flex flex-col justify-between"
            >
              <div className="p-5 flex h-[130px] flex-col space-y-3">
                <div className="flex rtl:space-x-reverse space-x-2 items-center mb-3">
                  {Array.from(Array(parseInt(item.rating)), () => (
                    <span key={Math.random()} className="text-[#FFB321]">
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
                  {parseInt(item.rating) < 5 && (
                    <>
                      {Array.from(Array(5 - parseInt(item.rating)), () => (
                        <span key={Math.random()} className="text-[#616161]">
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
                    </>
                  )}
                </div>
                <p className="text-base font-medium text-white line-clamp-3">
                  {item.comment}
                </p>
              </div>
              <div className="px-5 py-3 border-t border-primary-border flex rtl:space-x-reverse space-x-2.5">
                <div className="w-[38px] h-[38px] rounded-full overflow-hidden">
                  <img
                    src={process.env.BASE_URL + item.image}
                    alt=""
                    className="w-full h-full object-cover"
                  />
                </div>
                <div>
                  <p className="text-base font-semibold text-white">
                    {item.name}
                  </p>
                  <p className="text-sm">{item.designation}</p>
                </div>
              </div>
            </div>
          ))}
        </SwiperSliderCom>
      </div>
    );
  }
}

export default TestimonialSlider;
