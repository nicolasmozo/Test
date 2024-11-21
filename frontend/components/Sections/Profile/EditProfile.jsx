"use client";
import React, { useState, useRef, useEffect } from "react";
import img from "@/public/assets/img/profile-img.png";
import { useUpdateProfileMutation } from "@/store/features/profile/apiSlice";
import StringLang from "@/utilities/StringLang";

function EditProfile({ userInfo }) {
  const [editedInfo, setEditedInfo] = useState({
    name:
      userInfo?.name !== "null" && userInfo?.name !== null
        ? userInfo?.name
        : "",
    email:
      userInfo?.email !== "null" && userInfo?.email !== null
        ? userInfo?.email
        : "",
    phone:
      userInfo?.phone !== "null" && userInfo?.phone !== null
        ? userInfo?.phone
        : "",
    address:
      userInfo?.address !== "null" && userInfo?.address !== null
        ? userInfo?.address
        : "",
    about_me:
      userInfo?.about_me !== "null" && userInfo?.about_me !== null
        ? userInfo?.about_me
        : "",
    previewImage: userInfo.image ? process.env.BASE_URL + userInfo.image : null,
    image: "",
  });

  const [updateProfile, { isLoading }] = useUpdateProfileMutation();
  //   handle change
  const handleTextInput = (e) => {
    setEditedInfo((prev) => ({
      ...prev,
      [e.target.getAttribute("name")]: e.target.value,
    }));
  };
  const profile_about = useRef(null);
  useEffect(() => {
    if (profile_about && profile_about.current) {
      const decodeText = profile_about.current?.innerText;
      setEditedInfo((prev) => ({
        ...prev,
        about_me: decodeText,
      }));
    }
  }, [profile_about]);

  //   picture update
  const handlePictureUpdate = (e) => {
    if (e.target.value !== "") {
      const imgReader = new FileReader();
      imgReader.onload = (event) => {
        setEditedInfo((prev) => ({
          ...prev,
          previewImage: event.target.result,
        }));
      };
      imgReader.readAsDataURL(e.target.files[0]); //view
      setEditedInfo((prev) => ({ ...prev, image: e.target.files[0] }));
    }
  };
  handlePictureUpdate.bind(this);

  // handle submit
  const handleUpdate = () => {
    updateProfile({ profileInfo: editedInfo });
  };

  return (
    <>
      <div className="grid grid-cols-2 gap-8 mb-5">
        <div className="col-span-2">
          <p className="text-lg font-semibold text-white  inline-block ">
            <StringLang string="Profile Picture" />*
          </p>
          <p className="text-base font-medium text-bgray-600">
            <StringLang string="Size 300x300px" />
          </p>
          <div className="mt-4 relative rounded-lg overflow-hidden w-fit flex flex-col items-center">
            <img
              src={`${editedInfo?.previewImage}`}
              alt=""
              className="w-[200px] h-[200px] rounded-full overflow-hidden"
            />
            <label
              htmlFor="cover"
              className=" absolute h-[50px] w-[50px] rounded-full flex justify-center items-center bg-[#FE964A] bottom-3.5 right-3.5"
            >
              <svg
                width="22"
                height="23"
                viewBox="0 0 22 23"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M12.051 4.76758C13.9476 6.67599 15.8149 8.55495 17.6997 10.4516C17.4656 10.6813 17.2139 10.9169 16.9739 11.1643C13.5437 14.6159 10.1076 18.0676 6.67734 21.5192C6.45491 21.743 6.23832 21.9669 6.01588 22.1789C5.9632 22.226 5.88125 22.2673 5.81101 22.2673C4.02565 22.2731 2.24029 22.2673 0.454935 22.2731C0.332008 22.2731 0.308594 22.226 0.308594 22.12C0.308594 20.3353 0.308594 18.5447 0.314447 16.7599C0.314447 16.6775 0.355423 16.5774 0.408105 16.5243C2.51541 14.398 4.62272 12.2775 6.73003 10.1571C8.48026 8.39592 10.2246 6.64065 11.9749 4.87949C12.01 4.84415 12.0276 4.79703 12.051 4.76758Z"
                  fill="white"
                ></path>
                <path
                  d="M18.9828 9.15481C17.0979 7.25817 15.2247 5.37332 13.3574 3.49436C13.6911 3.14684 14.0364 2.79343 14.3818 2.44002C14.7857 2.0336 15.1955 1.62718 15.6052 1.22076C16.1203 0.708315 16.8286 0.708315 17.3379 1.22076C18.6315 2.50481 19.9193 3.79476 21.213 5.07881C21.7164 5.57948 21.734 6.29219 21.2481 6.79874C20.5047 7.57624 19.7554 8.34785 19.012 9.12536C19.0062 9.13714 18.9886 9.14892 18.9828 9.15481Z"
                  fill="white"
                ></path>
              </svg>
            </label>
            <input
              id="cover"
              className="w-0 h-0 absolute opacity-0"
              type="file"
              onChange={handlePictureUpdate}
              name=""
            />
          </div>
        </div>
        <div className="w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px]  inline-block px-[5px]">
              Name*
            </label>
            <input
              type="text"
              placeholder="Name"
              name="name"
              value={editedInfo?.name}
              onChange={handleTextInput}
              className="w-full h-full rounded-[5px] bg-[#0B0E12] text-white border border-[#23262B] px-4 focus:outline-none"
            />
          </div>
        </div>
        <div className="w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px]  inline-block px-[5px]">
              Email*
            </label>
            <input
              type="text"
              placeholder="Name"
              value={editedInfo?.email}
              disabled={true}
              className="w-full h-full rounded-[5px] bg-[#0B0E12] text-white border border-[#23262B] px-4 focus:outline-none"
            />
          </div>
        </div>
        <div className="w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px]  inline-block px-[5px]">
              Address*
            </label>
            <input
              type="text"
              placeholder="Enter Your Address."
              name="address"
              value={editedInfo?.address}
              onChange={handleTextInput}
              className="w-full h-full  rounded-[5px] bg-[#0B0E12] text-white border border-[#23262B] px-4 focus:outline-none"
            />
          </div>
        </div>
        <div className="w-full">
          <div className="input-field h-[50px] relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px]  inline-block px-[5px]">
              Phone Number*
            </label>
            <input
              type="text"
              placeholder="01001325"
              name="phone"
              value={editedInfo?.phone}
              onChange={handleTextInput}
              className="w-full h-full  rounded-[5px] bg-[#0B0E12] text-white border border-[#23262B] px-4 focus:outline-none"
            />
          </div>
        </div>
        <div className="col-span-full w-full">
          <div className="input-field relative">
            <label className="text-sm text-white bg-black bg-opacity-30 absolute rtl:left-auto rtl:right-3 ltr:left-3 ltr:right-auto  -top-[9px]  inline-block px-[5px]">
              About your self*
            </label>
            <textarea
              placeholder="Write a Comment"
              name="about_me"
              value={editedInfo?.about_me}
              onChange={handleTextInput}
              className="w-full h-[170px]  rounded-[5px] bg-[#0B0E12] text-white border border-[#23262B] p-4 focus:outline-none resize-none"
            ></textarea>
            <p
              ref={profile_about}
              className="h-0 overflow-hidden"
              dangerouslySetInnerHTML={{
                __html:
                  userInfo?.about_me !== "null" && userInfo?.about_me !== null
                    ? userInfo?.about_me.replace(/<[^>]*>/g, "")
                    : "",
              }}
            ></p>
          </div>
        </div>
      </div>
      <div className="flex justify-end">
        <button
          onClick={() => {
            handleUpdate();
          }}
          type="button"
          disabled={isLoading}
        >
          <div className="px-[36px] py-5 rounded-[5px] bg-primary-yellow  hover:bg-white hover:text-black  group common-transition relative overflow-hidden">
            <span className="text-base font-semibold text-primary-black  common-transition group-hover:text-black relative z-10">
              <StringLang string="Save Change" />
            </span>
            <div className="absolute left-0 top-0 w-full h-full"></div>
          </div>
        </button>
      </div>
    </>
  );
}

export default EditProfile;
