"use client";
import { useSubmitCommentMutation } from "@/store/features/blogComment/apiSlice";
import React, { useEffect, useState } from "react";
import StringLang from "@/utilities/StringLang";
const initialState = {
  name: "",
  email: "",
  comment: "",
};
function CommentForm({ blogId }) {
  const [info, setInfo] = useState(initialState);
  const [isError, setIsError] = useState(false);
  let error = initialState;
  const [submitComment, { isLoading, isSuccess }] = useSubmitCommentMutation();

  // validation checker
  // email checker
  function isValidEmail(email) {
    // Regular expression pattern for email validation
    var emailPattern = /\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/i;
    return !emailPattern.test(email);
  }

  const validator = () => {
    setIsError(false);
    if (info.name === "") {
      error = { ...error, name: "Please Enter Your name" };
      setIsError({ ...error });
    }
    if (info.email === "") {
      error = { ...error, email: "Please Enter Your email" };
      setIsError({ ...error });
    } else if (isValidEmail(info.email)) {
      error = {
        ...error,
        email: "Invalid! Please enter a valid email",
      };
      setIsError({ ...error });
    }
    if (info.comment === "") {
      error = { ...error, comment: "Please Enter Your comment" };
      setIsError({ ...error });
    }
  };

  const handleChange = (e) => {
    setInfo((prev) => ({
      ...prev,
      [e.target.getAttribute("name")]: e.target.value,
    }));
    handleChange.bind(this);
  };

  // submit handler
  const handleSubmit = () => {
    validator();
    if (!Object.entries(error).filter(([k, v], i) => !!v)[0]) {
      submitComment({
        comment: info,
        blogId: blogId,
        resetForm: () => setInfo(initialState),
      });
    }
  };

  return (
    <div className="w-full md:px-[30px] md:py-10 p-5 border-[#23262B] border bg-black rounded-[5px]">
      <p className="text-xl font-bold text-primary-blue leading-8 mb-5">
        <StringLang string="Write Your Comment" />
      </p>
      <div className="grid md:grid-cols-2 grid-cols-1 gap-5 mb-5">
        <div className="w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              <span className=" relative z-10">Name*</span>
              <div className="w-full h-0.5 bg-white relative z-0"></div>
            </label>
            <input
              type="text"
              placeholder="Name"
              name="name"
              value={info.name}
              onChange={handleChange}
              className={`w-full h-full text-white bg-[#0B0E12]   rounded-[5px] border ${
                isError?.name ? " border-red-500/50" : "border-[#23262B]"
              } px-4 focus:outline-none`}
            />
          </div>
          {isError?.name ? (
            <p className="pt-2 px-2 text-red-500">{isError?.name}</p>
          ) : (
            ""
          )}
        </div>
        <div className="w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm bg-black bg-opacity-30 text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              <span className=" relative z-10">Email*</span>
              <div className="w-full h-0.5 bg-white relative z-0"></div>
            </label>
            <input
              type="text"
              placeholder="Email"
              name="email"
              value={info.email}
              onChange={handleChange}
              className={`w-full h-full text-white bg-[#0B0E12]   rounded-[5px] border ${
                isError?.email ? " border-red-500/50" : "border-[#23262B]"
              } px-4 focus:outline-none`}
            />
          </div>
          {isError?.email ? (
            <p className="pt-2 px-2 text-red-500">{isError?.email}</p>
          ) : (
            ""
          )}
        </div>
        <div className="col-span-full w-full">
          <div className="input-field relative">
            <label className="text-sm bg-black bg-opacity-30 text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center ">
              <span className=" relative z-10">Comment*</span>
              <div className="w-full h-0.5 bg-white relative z-0"></div>
            </label>
            <textarea
              name="comment"
              value={info.comment}
              onChange={handleChange}
              placeholder="Write a Comment"
              className={`w-full h-[170px] text-white bg-[#0B0E12]   rounded-[5px] border ${
                isError?.comment ? " border-red-500/50" : "border-[#23262B]"
              } p-4 focus:outline-none resize-none`}
            ></textarea>
            {isError?.comment ? (
              <p className="pt-2 px-2 text-red-500">{isError?.comment}</p>
            ) : (
              ""
            )}
          </div>
        </div>
      </div>
      <button disabled={isLoading} onClick={handleSubmit} type="button">
        <div className="lg:px-5 lg:py-2.5 px-1.5 py-1 rounded-[5px] bg-primary-yellow group  hover:bg-white hover:text-black  common-transition">
          <span className="text-base font-semibold text-primary-black  common-transition group-hover:text-black">
            <StringLang string="Submit Comment" />
          </span>
        </div>
      </button>
    </div>
  );
}

export default CommentForm;
