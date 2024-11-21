"use client";
import React, { useEffect, useState } from "react";
import { useSendContactMessageMutation } from "@/store/features/contact/apiSlice";
import SvgLoader from "@/components/Helper/Loader/SvgLoader";
import StringLang from "@/utilities/StringLang";

function MessageForm({ title }) {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    subject: "",
    phone: "",
    message: "",
  });
  const [errors, setErrors] = useState(null);
  const formHandler = (event) => {
    setFormData((prev) => ({
      ...prev,
      [event.target.name]: event.target.value,
    }));
  };
  const resetHandler = () => {
    setFormData({
      name: "",
      email: "",
      subject: "",
      phone: "",
      message: "",
    });
    setErrors(null);
  };
  const [sendContactMessage, { isLoading, error, isSuccess }] =
    useSendContactMessageMutation();
  useEffect(() => {
    if (error) {
      setErrors(error?.data.errors);
    }
    if (isSuccess) {
      resetHandler();
    }
  }, [error, isSuccess]);

  const handleSubmit = (e) => {
    e.preventDefault();
    sendContactMessage(formData);
  };
  return (
    <div
      style={{ boxShadow: "0px 0px 30px 5px rgba(0, 0, 0, 0.08)" }}
      className="w-full md:py-[35px] md:px-10 p-5 rounded-[5px] bg-black"
    >
      <p className="text-[24px] font-semibold text-white leading-8 mb-5">
        {title}
      </p>
      <div className="grid md:grid-cols-2 grid-cols-1 gap-7 mb-5">
        <div className="w-full">
          <div className="input-field relative">
            <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
              Name*
            </label>
            <input
              type="text"
              name="name"
              value={formData.name}
              onChange={(e) => formHandler(e)}
              placeholder="Name"
              className="w-full  h-[50px]  text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
            />
            {errors && Object.hasOwn(errors, "email") ? (
              <span className="text-sm mt-1 text-red-500">
                {errors.name[0]}
              </span>
            ) : (
              ""
            )}
          </div>
        </div>
        <div className="w-full">
          <div className="input-field  relative">
            <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
              Phone
            </label>
            <input
              type="text"
              name="phone"
              value={formData.phone}
              onChange={(e) => formHandler(e)}
              placeholder="Phone"
              className="w-full h-[50px]  rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
            />
            {errors && Object.hasOwn(errors, "phone") ? (
              <span className="text-sm mt-1 text-red-500">
                {errors.phone[0]}
              </span>
            ) : (
              ""
            )}
          </div>
        </div>
        <div className="w-full">
          <div className="input-field  relative">
            <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
              Email*
            </label>
            <input
              type="email"
              name="email"
              value={formData.email}
              onChange={(e) => formHandler(e)}
              placeholder="Email"
              className="w-full h-[50px]  rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
            />
            {errors && Object.hasOwn(errors, "email") ? (
              <span className="text-sm mt-1 text-red-500">
                {errors.email[0]}
              </span>
            ) : (
              ""
            )}
          </div>
        </div>
        <div className="w-full">
          <div className="input-field  relative">
            <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
              Subject*
            </label>
            <input
              type="text"
              placeholder="Subject"
              name="subject"
              value={formData.subject}
              onChange={(e) => formHandler(e)}
              className="w-full h-[50px]  rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
            />
            {errors && Object.hasOwn(errors, "subject") ? (
              <span className="text-sm mt-1 text-red-500">
                {errors.subject[0]}
              </span>
            ) : (
              ""
            )}
          </div>
        </div>
        <div className="col-span-full w-full">
          <div className="input-field relative">
            <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
              Message*
            </label>
            <textarea
              name="message"
              value={formData.message}
              onChange={(e) => formHandler(e)}
              placeholder="Write a Comment"
              className="w-full h-[170px]  rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 p-4 focus:outline-none resize-none"
            ></textarea>
            {errors && Object.hasOwn(errors, "message") ? (
              <span className="text-sm mt-1 text-red-500">
                {errors.message[0]}
              </span>
            ) : (
              ""
            )}
          </div>
        </div>
      </div>
      <button onClick={handleSubmit} type="button">
        <div className="lg:px-5 lg:py-2.5 px-4 py-2.5 rounded-[5px] bg-primary-blue  hover:bg-white hover:text-black  group common-transition">
          <div className="flex rtl:space-x-reverse space-x-2 items-center">
            <span className="text-base  text-primary-black  common-transition group-hover:text-black">
              <StringLang string="Send Message" />
            </span>
            <span>
              {isLoading && <SvgLoader className="text-primary-black" />}
            </span>
          </div>
        </div>
      </button>
    </div>
  );
}

export default MessageForm;
