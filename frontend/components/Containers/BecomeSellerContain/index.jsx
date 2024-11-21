"use client";
import React, { useEffect, useState } from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import { useBecomeSellerMutation } from "@/store/features/seller/become-seller/apiSlice";
import SvgLoader from "@/components/Helper/Loader/SvgLoader";
import { useRouter } from "next/navigation";
import StringLang from "@/utilities/StringLang";

function Index() {
  const router = useRouter();
  const [errors, setErrors] = useState(null);
  const [sellerData, setSellerData] = useState({
    company_name: "",
    email: "",
    phone: "",
    address: "",
    document_type: "NID",
    document: null,
    logo: null,
  });
  const formEventHandler = (e) => {
    setSellerData((prev) => ({
      ...prev,
      [e.target.name]: e.target.value,
    }));
  };
  const fileHandler = (e) => {
    if (e.target.value !== "") {
      setSellerData((prev) => ({
        ...prev,
        [e.target.name]: e.target.files[0],
      }));
    }
  };
  const [becomeSeller, { isLoading, error }] = useBecomeSellerMutation();
  const siteURL = typeof window !== "undefined" ? window.location.origin : "";
  const sendSellerRequest = () => {
    becomeSeller({
      ...sellerData,
      callback_url: siteURL,
      resetForm: () =>
        setSellerData({
          company_name: "",
          email: "",
          phone: "",
          address: "",
          document_type: "NID",
          document: null,
          logo: null,
        }),
      redirect: () => router.push("/"),
    });
  };
  useEffect(() => {
    if (error) {
      setErrors(error?.data?.errors);
    }
  }, [error]);

  return (
    <>
      <PageTitleArea
        title="Become Seller"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "Become Seller", path: "/auth/become-seller" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="w-full lg:px-[100px]">
            <div className="w-full bg-black rounded-[5px] md:px-[60px] md:py-10 p-5">
              <div className="mb-7">
                <div className="title w-full mb-7">
                  <h1 className="text-[22px] font-semibold text-white mb-2">
                    <StringLang string="Company Information" />
                  </h1>
                  <p className="text-[15px]">
                    <StringLang string="Fill the form below or write us We will help you as soon as possible" />
                  </p>
                </div>
                <div className="input-forms">
                  <div className="grid grid-cols-2 gap-[30px] mb-5">
                    <div className="col-span-full w-full">
                      <div className="input-field h-[50px] relative">
                        <label className="text-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
                          Name*
                        </label>
                        <input
                          type="text"
                          name="company_name"
                          value={sellerData.company_name}
                          onChange={(e) => formEventHandler(e)}
                          placeholder="Name"
                          className="w-full  h-[50px]  text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
                        />
                      </div>
                      {errors && Object.hasOwn(errors, "company_name") ? (
                        <span className="text-sm mt-1 text-red-500">
                          {errors.company_name[0]}
                        </span>
                      ) : (
                        ""
                      )}
                    </div>
                    <div className=" w-full">
                      <div className="input-field h-[50px] relative">
                        <label className="ext-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
                          Email*
                        </label>
                        <input
                          type="email"
                          name="email"
                          value={sellerData.email}
                          onChange={(e) => formEventHandler(e)}
                          placeholder="Email"
                          className="w-full  h-[50px]  text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
                        />
                      </div>
                      {errors && Object.hasOwn(errors, "email") ? (
                        <span className="text-sm mt-1 text-red-500">
                          {errors.email[0]}
                        </span>
                      ) : (
                        ""
                      )}
                    </div>
                    <div className=" w-full">
                      <div className="input-field h-[50px] relative">
                        <label className="ext-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
                          Phone*
                        </label>
                        <input
                          type="text"
                          name="phone"
                          value={sellerData.phone}
                          onChange={(e) => formEventHandler(e)}
                          placeholder="Phone"
                          className="w-full  h-[50px]  text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
                        />
                      </div>
                      {errors && Object.hasOwn(errors, "phone") ? (
                        <span className="text-sm mt-1 text-red-500">
                          {errors.phone[0]}
                        </span>
                      ) : (
                        ""
                      )}
                    </div>
                    <div className="col-span-full w-full">
                      <div className="input-field h-[50px] relative">
                        <label className="ext-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
                          Address*
                        </label>
                        <input
                          type="text"
                          name="address"
                          value={sellerData.address}
                          onChange={(e) => formEventHandler(e)}
                          placeholder="Address"
                          className="w-full  h-[50px]  text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
                        />
                      </div>
                      {errors && Object.hasOwn(errors, "address") ? (
                        <span className="text-sm mt-1 text-red-500">
                          {errors.address[0]}
                        </span>
                      ) : (
                        ""
                      )}
                    </div>
                  </div>
                </div>
              </div>
              <div className="mb-3">
                <div className="title w-full mb-7">
                  <h1 className="text-[22px] font-semibold text-white mb-2">
                    <StringLang string="Upload Documents" />
                  </h1>
                  <p className="text-[15px]">
                    <StringLang string="Upload your valid documents for approval your request" />
                  </p>
                </div>
                <div className="input-forms">
                  <div className="grid grid-cols-2 gap-[20px] mb-5">
                    <div className="w-full">
                      <div className="input-field h-[50px] relative">
                        <label className="ext-sm text-white absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px] bg-black bg-opacity-30 inline-block px-[5px]">
                          Select Documents*
                        </label>
                        <select
                          value={sellerData.document_type}
                          onChange={(e) =>
                            setSellerData((prev) => ({
                              ...prev,
                              document_type: e.target.value,
                            }))
                          }
                          className="w-full  h-[50px]  text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B] focus:outline-0 px-4 focus:outline-none"
                        >
                          <option value="NID">NID</option>
                          <option value="License">License</option>
                          <option value="Passport">Passport</option>
                        </select>
                      </div>
                      {errors && Object.hasOwn(errors, "document_type") ? (
                        <span className="text-sm mt-1 text-red-500">
                          {errors.document_type[0]}
                        </span>
                      ) : (
                        ""
                      )}
                    </div>
                    <div className="col-span-full w-full">
                      <div className="grid grid-cols-2 gap-[30px]">
                        <div>
                          <div className="input-field relative">
                            <label className="text-sm text-white inline-block mb-2">
                              Upload Company Document*
                            </label>
                            <input
                              accept="image/*"
                              name="document"
                              onChange={(e) => fileHandler(e)}
                              className="block w-full rounded-[5px] border border-[#23262B] bg-[#0B0E12] text-sm text-[#23262B] file:mr-4 rtl:file:ml-4 rtl:file:mr-0  file:py-3 file:px-8 file:border-0 file:text-base file:font-medium file:bg-[#23262B] file:text-white "
                              type="file"
                            />
                          </div>
                          {errors && Object.hasOwn(errors, "document") ? (
                            <span className="text-sm mt-1 text-red-500">
                              {errors.document[0]}
                            </span>
                          ) : (
                            ""
                          )}
                        </div>
                        <div>
                          <div className="input-field relative">
                            <label className="text-sm text-white inline-block mb-2">
                              Upload Company Logo*
                            </label>
                            <input
                              accept="image/*"
                              name="logo"
                              onChange={(e) => fileHandler(e)}
                              className="block w-full rounded-[5px] border border-[#23262B] bg-[#0B0E12] text-sm text-[#23262B] file:mr-4 rtl:file:ml-4 rtl:file:mr-0  rtl:file:ml-4 rtl:file:mr-0 file:py-3 file:px-8 file:border-0 file:text-base file:font-medium file:bg-[#23262B] file:text-white "
                              type="file"
                            />
                          </div>
                          {errors && Object.hasOwn(errors, "logo") ? (
                            <span className="text-sm mt-1 text-red-500">
                              {errors.logo[0]}
                            </span>
                          ) : (
                            ""
                          )}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className=" mb-[45px]">
                <div className="flex rtl:space-x-reverse space-x-3 items-center">
                  <span>
                    <input
                      type="checkbox"
                      className="h-5 w-5 rounded border border-primary-blue bg-transparent accent-primary-blue"
                      name="agree"
                    />
                  </span>
                  <p className="text-base leading-[26px] ">
                    <StringLang string="I agree all" />{" "}
                    <a href="/terms-conditions" className="text-primary-blue">
                      <StringLang string="terms and condition" />
                    </a>{" "}
                    <StringLang string="in Alasmart" />
                  </p>
                </div>
              </div>
              <button
                onClick={sendSellerRequest}
                type="button"
                className="w-full h-[62px] rounded bg-primary-blue text-primary-black flex justify-center items-center text-[18px] font-semibold"
              >
                <div className="flex rtl:space-x-reverse space-x-2 items-center">
                  <span className="text-base  text-primary-black">
                    {" "}
                    <StringLang string="Request for Seller" />
                  </span>
                  <span>
                    {isLoading && <SvgLoader className="text-primary-black" />}
                  </span>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

export default Index;
