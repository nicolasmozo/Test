import React from "react";

function CounterSection({ datas }) {
  if (datas) {
    return (
      <div className="w-full pt-[60px]">
        <div className="w-full h-[204px] bg-primary-blue ">
          <div className="theme-container mx-auto h-full">
            <div className="w-ful h-full flex justify-between flex-wrap items-center gap-5">
              <div className="flex flex-col lg:space-y-3 rtl:space-x-reverse space-x-1">
                <span className="text-primary-black lg:text-[65px] font-semibold tracking-wider lg:leading-[65px] text-3xl">
                  {datas.counter1_value}k
                </span>
                <span className="text-primary-black text-lg">
                  {datas.counter1_title}
                </span>
              </div>
              <div className="flex flex-col lg:space-y-3 rtl:space-x-reverse space-x-1">
                <span className="text-primary-black lg:text-[65px] font-semibold tracking-wider lg:leading-[65px] text-3xl">
                  {datas.counter2_value}+
                </span>
                <span className="text-primary-black text-lg ">
                  {datas.counter2_title}
                </span>
              </div>
              <div className="flex flex-col lg:space-y-3 rtl:space-x-reverse space-x-1">
                <span className="text-primary-black lg:text-[65px] font-semibold tracking-wider lg:leading-[65px] text-3xl">
                  {datas.counter3_value}%
                </span>
                <span className="text-primary-black text-lg">
                  {datas.counter3_title}
                </span>
              </div>
              <div className="flex flex-col lg:space-y-3 rtl:space-x-reverse space-x-1">
                <span className="text-primary-black lg:text-[65px] font-semibold tracking-wider lg:leading-[65px] text-3xl">
                  {datas.counter4_value}k
                </span>
                <span className="text-primary-black text-lg ">
                  {datas.counter4_title}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default CounterSection;
