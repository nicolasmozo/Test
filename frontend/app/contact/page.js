import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import MessageForm from "@/components/Sections/Contact/MessageForm";
import { notFound } from "next/navigation";
async function getData() {
  const res = await fetch(
    `${process.env.BASE_URL}api/contact-us?lang_code=en`,
    {
      cache: "no-store",
    }
  );
  if (res.ok) {
    return res?.json();
  } else {
    notFound();
  }
}
export async function generateMetadata() {
  const { seo_setting } = await getData();
  return {
    title: seo_setting?.seo_title,
    description: seo_setting?.seo_description,
  };
}
async function Page() {
  const { contact } = await getData();
  return (
    <>
      <PageTitleArea
        title="Contact"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "contact", path: "/contact" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container  mx-auto">
          <div className="w-full lg:flex lg:rtl:space-x-reverse space-x-[30px] mb-10">
            {/*contact form*/}
            <div className="flex-1 mb-5 lg:mb-0">
              <MessageForm title={contact.title1} />
            </div>
            <div className="lg:w-[370px] w-full">
              <div className="w-full  rounded-[5px] bg-black">
                <div className="w-full h-[270px] flex justify-center items-center">
                  <div>
                    <div className="w-full flex justify-center">
                      <div className="w-[74px] h-[74px] flex justify-center items-center rounded-full bg-[#23262B] mb-5 p-4">
                        <img
                          src="/assets/img/contact-headphone.png"
                          alt=""
                          className="w-full h-full object-contain"
                        />
                      </div>
                    </div>
                    <div className="flex flex-col rtl:space-x-reverse space-x-">
                      <p className="text-base text-white text-center">
                        {contact.title2}
                      </p>
                      <p className="text-xl text-white font-bold">
                        {" "}
                        {contact.time}
                      </p>
                      <p className="text-base text-white text-center">
                        {" "}
                        {contact.off_day}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="w-full h-[266px]">
                <img
                  src={process.env.BASE_URL + contact.image}
                  className="w-full h-full object-cover object-top"
                  alt=""
                />
              </div>
            </div>
          </div>
          <div className="w-full grid lg:grid-cols-3 grid-cols-1 gap-[30px] mb-10">
            <div className="item w-full">
              <div
                style={{ boxShadow: "0px 4px 30px 5px rgba(0, 0, 0, 0.08)" }}
                className="w-full h-[236px] bg-black common-transition flex justify-center items-center group rounded-[5px] p-5"
              >
                <div className="w-full">
                  <div className="flex justify-center mb-[30px]">
                    <div className="w-[60px] h-[60px] rounded-full bg-primary-blue text-primary-black  common-transition flex justify-center items-center">
                      <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        className="text-primary-black"
                      >
                        <path
                          d="M19 17V15.3541C19 14.5363 18.5021 13.8008 17.7428 13.4971L15.7086 12.6835C14.7429 12.2971 13.6422 12.7156 13.177 13.646L13 14C13 14 10.5 13.5 8.5 11.5C6.5 9.5 6 7 6 7L6.35402 6.82299C7.28438 6.35781 7.70285 5.25714 7.31654 4.29136L6.50289 2.25722C6.19916 1.4979 5.46374 1 4.64593 1H3C1.89543 1 1 1.89543 1 3C1 11.8366 8.16344 19 17 19C18.1046 19 19 18.1046 19 17Z"
                          stroke="currentColor"
                          strokeWidth="1.5"
                          strokeLinejoin="round"
                        />
                      </svg>
                    </div>
                  </div>
                  <p className="text-2xl leading-[32px] text-white common-transition text-center">
                    {contact.phone}
                  </p>
                  <p className="text-2xl leading-[32px] text-white common-transition text-center">
                    {contact.phone2}
                  </p>
                </div>
              </div>
            </div>
            <div className="item w-full">
              <div
                style={{ boxShadow: "0px 4px 30px 5px rgba(0, 0, 0, 0.08)" }}
                className="w-full h-[236px] bg-black common-transition flex justify-center items-center group rounded-[5px] p-5"
              >
                <div className="w-full">
                  <div className="flex justify-center mb-[30px]">
                    <div className="w-[60px] h-[60px] rounded-full bg-primary-blue text-primary-black  common-transition flex justify-center items-center">
                      <svg
                        className="text-primary-black"
                        width="22"
                        height="20"
                        viewBox="0 0 22 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M5 6L8.7812 8.5208C10.1248 9.41653 11.8752 9.41653 13.2188 8.5208L13.7092 8.19389M12.8027 1H5C2.79086 1 1 2.79086 1 5V15C1 17.2091 2.79086 19 5 19H17C19.2091 19 21 17.2091 21 15V9.19731M21 4C21 5.65685 19.6569 7 18 7C16.3431 7 15 5.65685 15 4C15 2.34315 16.3431 1 18 1C19.6569 1 21 2.34315 21 4Z"
                          stroke="currentColor"
                          strokeWidth="1.5"
                          strokeLinecap="round"
                        />
                      </svg>
                    </div>
                  </div>
                  <p className="text-2xl leading-[32px] text-white common-transition text-center">
                    {contact.email}
                  </p>
                  <p className="text-2xl leading-[32px] text-white common-transition text-center">
                    {contact.email2}
                  </p>
                </div>
              </div>
            </div>
            <div className="item w-full">
              <div
                style={{ boxShadow: "0px 4px 30px 5px rgba(0, 0, 0, 0.08)" }}
                className="w-full h-[236px] bg-black common-transition flex justify-center items-center group rounded-[5px] p-5"
              >
                <div className="w-full">
                  <div className="flex justify-center mb-[30px]">
                    <div className="w-[60px] h-[60px] rounded-full bg-primary-blue text-primary-black  common-transition flex justify-center items-center">
                      <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        className="text-primary-black"
                      >
                        <circle
                          cx="12"
                          cy="11"
                          r="3"
                          stroke="currentColor"
                          strokeWidth="1.5"
                        />
                        <path
                          d="M21 10.8889C21 15.7981 15.375 22 12 22C8.625 22 3 15.7981 3 10.8889C3 5.97969 7.02944 2 12 2C16.9706 2 21 5.97969 21 10.8889Z"
                          stroke="currentColor"
                          strokeWidth="1.5"
                        />
                      </svg>
                    </div>
                  </div>
                  <p
                    className="text-2xl leading-[32px] text-white common-transition text-center"
                    dangerouslySetInnerHTML={{
                      __html: contact.address.replace(/<[^>]*>/g, ""),
                    }}
                  ></p>
                </div>
              </div>
            </div>
          </div>
          <div
            style={{ boxShadow: "0px 6px 60px 5px rgba(0, 0, 0, 0.08)" }}
            className="contact-iframe w-full h-[426px] bg-black rounded-[5px] p-[30px]"
          >
            <iframe
              src={contact.map}
              className="w-full h-full"
              loading="lazy"
            ></iframe>
          </div>
        </div>
      </div>
    </>
  );
}

export default Page;
