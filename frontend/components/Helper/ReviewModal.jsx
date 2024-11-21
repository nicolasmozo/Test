"use client";
import { useReviewMutation } from "@/store/features/order/apiSlice";
import React, { useState } from "react";
import StringLang from "@/utilities/StringLang";

function ReviewModal({ close, orderId }) {
  const [reviewData, setReviewData] = useState({
    rating: 5,
    review: "",
  });
  const handleReviewRating = (index) => {
    setReviewData((prev) => ({ ...prev, rating: index + 1 }));
  };
  const handleTextInput = (e) => {
    setReviewData((prev) => ({
      ...prev,
      [e.target.getAttribute("name")]: e.target.value,
    }));
  };
  handleTextInput.bind(this);
  const resetForm = () =>
    setReviewData({
      rating: 5,
      review: "",
    });

  const [addReview, { isLoading }] = useReviewMutation();
  return (
    <div
      data-aos="fade-up"
      className="w-[771px] bg-black rounded-[5px] p-[30px]"
    >
      <div className="flex justify-between items-center mb-7">
        <p className="text-[24px] font-bold text-white leading-8 text-center">
          <StringLang string="Write Your Reviews" />
        </p>
        <button
          onClick={close}
          type="button"
          className="w-[30px] h-[30px] rounded-full flex justify-center items-center bg-[#F91738]/15"
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
          <div className="input-field h-[64px] relative">
            <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-[#0B0E13] bg-opacity-30 inline-block  w-fit h-fit">
              <div className="h-1/2  w-full bg-black absolute "></div>
              <span className="px-[5px] relative z-10">Rating*</span>
            </label>
            <div className="w-full h-full bg-[#0B0E13] rounded-[5px] border border-white/10 px-4 flex items-center">
              <div className="flex rtl:space-x-reverse space-x-2 items-center ">
                {new Array(1, 2, 3, 4, 5).map((_, index) => {
                  return (
                    <button
                      onClick={() => handleReviewRating(index)}
                      key={index + "star"}
                      className={
                        reviewData.rating > index
                          ? `text-[#FFB321]`
                          : `text-white/20`
                      }
                    >
                      {" "}
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
                    </button>
                  );
                })}
              </div>
            </div>
          </div>
        </div>
        <div className="col-span-full w-full">
          <div className="input-field relative">
            <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-[#0B0E13] bg-opacity-30 inline-block  w-fit h-fit">
              <div className="h-1/2  w-full bg-black absolute "></div>
              <span className="px-[5px] relative z-10">Review*</span>
            </label>
            <textarea
              name="review"
              value={reviewData.review}
              onChange={handleTextInput}
              placeholder="Write a Comment"
              className="w-full h-[108px] bg-[#0B0E13] rounded-[5px] border border-white/10 p-4 focus:outline-none resize-none"
            ></textarea>
          </div>
        </div>
      </div>
      <div className="flex justify-end">
        <button
          disabled={isLoading}
          onClick={() => {
            addReview({
              orderId,
              reviewInfo: reviewData,
              resetForm,
              closeModal: close,
            });
          }}
          type="button"
        >
          <div className="px-[36px] py-5 rounded-[5px] bg-primary-yellow group  hover:bg-white hover:text-black  common-transition relative overflow-hidden">
            <span className="text-base font-semibold text-primary-black  common-transition group-hover:text-black relative z-10">
              <StringLang string="Submit Review" />
            </span>
            <div className="absolute left-0 top-0 w-full h-full"></div>
          </div>
        </button>
      </div>
    </div>
  );
}

export default ReviewModal;
