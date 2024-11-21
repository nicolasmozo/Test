"use client";
import React, { useEffect, useState } from "react";
import Modal from "@/components/Helper/Modal";
import { useProfileQuery } from "@/store/features/profile/apiSlice";
import EditProfile from "./EditProfile";
import StringLang from "@/utilities/StringLang";

function ProfileTab() {
  const [toggleModal, setToggleModal] = useState(false);
  const { data } = useProfileQuery();
  return (
    <div className="w-full md:p-10 p-5 relative bg-black rounded-md">
      <div className="w-full md:flex md:rtl:space-x-reverse space-x-4  items-center mb-[30px]">
        <div className="w-[150px] h-[150px] rounded-full overflow-hidden mb-5 md:mb-0 border-2 border-white">
          <img
            src={
              data?.user?.previewImage
                ? data.user.previewImage
                : process.env.BASE_URL + data?.user?.image
            }
            alt=""
            className="w-full h-full object-cover"
          />
        </div>
        <div className="flex-1">
          <div className="w-full ">
            <div className="border-b border-[#23262B] mb-2.5">
              <h2 className="text-2xl font-bold leading-8 text-white notranslate">
                {data?.user?.name}
              </h2>
              <p className="text-lg text-[#CCCCCC] mb-2.5 notranslate">
                {data?.user?.email}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div className="w-full">
        <h2 className="text-2xl font-bold leading-8 text-white mb-2.5">
          <StringLang string="About Me" />
        </h2>
        <p
          className="text-base text-[#CCCCCC] group-hover:text-primary-blue common-transition"
          dangerouslySetInnerHTML={{
            __html:
              data?.user?.about_me !== null && data?.user?.about_me !== "null"
                ? data?.user?.about_me.replace(/<[^>]*>/g, "")
                : "",
          }}
        ></p>
      </div>
      <button
        onClick={() => setToggleModal(!toggleModal)}
        type="button"
        className="absolute ltr:right-[14px] ltr:left-auto rtl:left-[14px] rtl:right-auto top-[14px]"
      >
        <div className="lg:px-5 lg:py-2.5 px-1.5 py-1 rounded-[5px] bg-primary-yellow  hover:bg-white hover:text-black  group common-transition">
          <span className="text-base font-semibold text-primary-black  common-transition group-hover:text-black">
            <StringLang string="Edit Profile" />
          </span>
        </div>
      </button>
      {toggleModal && (
        <Modal onClose={() => setToggleModal(false)}>
          <div className="w-full h-screen fixed left-0 top-0  flex justify-center items-center">
            <div
              onClick={() => setToggleModal(false)}
              className="w-full h-full fixed left-0 top-0 bg-black bg-opacity-50"
            ></div>
            <div
              data-aos="fade-up"
              className="w-[771px] bg-black rounded-[5px] p-[30px]"
            >
              <div className="flex justify-between items-center mb-7">
                <p className="text-[24px] font-semibold text-white leading-8 text-center">
                  <StringLang string="Edit Profile" />
                </p>
                <button
                  onClick={() => setToggleModal(false)}
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
              <EditProfile userInfo={data?.user} />
            </div>
          </div>
        </Modal>
      )}
    </div>
  );
}

export default ProfileTab;
