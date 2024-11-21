import React, { useEffect, useRef, useState } from "react";
import SvgLoader from "@/components/Helper/Loader/SvgLoader";

function PaginateObserver({
  children,
  handler,
  lastPage,
  loading,
  currentPage,
  type = "onscroll",
}) {
  const observerEle = useRef(null);
  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        if (entries[0].isIntersecting) {
          if (!loading && lastPage > currentPage) {
            handler();
          }
        }
      },
      { threshold: 1 }
    );

    if (observerEle.current) {
      observer.observe(observerEle.current);
    }
    return () => {
      if (observerEle.current) {
        observer.unobserve(observerEle.current);
      }
    };
  }, [observerEle, loading, lastPage]);
  if (type === "onscroll") {
    return (
      <div>
        {children}
        <div ref={observerEle} className="flex justify-center mt-10">
          {loading && <SvgLoader />}
        </div>
      </div>
    );
  } else {
    return (
      <div>
        {children}

        {lastPage > currentPage && (
          <div className="flex justify-center mt-10">
            <button
              onClick={() => {
                handler();
              }}
              type="button"
            >
              <div className="py-4 px-8 flex rtl:space-x-reverse space-x-2.5 items-center bg-primary-blue group  hover:bg-white hover:text-black  common-transition rounded-[5px]">
                <div className="flex rtl:space-x-reverse space-x-2 items-center">
                  <span className="text-primary-black  common-transition group-hover:text-black text-base font-medium leading-5">
                    Show More ...
                  </span>
                  <span>
                    {loading && <SvgLoader className="text-primary-black" />}
                  </span>
                </div>
              </div>
            </button>
          </div>
        )}
      </div>
    );
  }
}

export default PaginateObserver;
