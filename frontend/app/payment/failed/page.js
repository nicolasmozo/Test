import React from "react";
import Link from "next/link";
import StringLang from "@/utilities/StringLang";
import PageTitleArea from "@/components/Common/PageTitleArea";
export function generateMetadata() {
  return {
    title: "Failed",
  };
}
function Page() {
  return (
    <>
      <div className=" h-screen flex justify-center items-center">
        <div className="bg-black p-6  md:mx-auto min-w-[300px]">
          <svg
            className="text-red-600 w-16 h-16 mx-auto my-6"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
          >
            <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 10.5858L9.17157 7.75736L7.75736 9.17157L10.5858 12L7.75736 14.8284L9.17157 16.2426L12 13.4142L14.8284 16.2426L16.2426 14.8284L13.4142 12L16.2426 9.17157L14.8284 7.75736L12 10.5858Z"></path>
          </svg>

          <div className="text-center">
            <h3 className="md:text-2xl text-base text-white font-semibold text-center">
              <StringLang string="Sorry, Payment Failed!" />
            </h3>
            <p className="text-gray-600 my-2">
              <StringLang string="Please try again!" />
            </p>
            <div className="py-10 text-center">
              <Link
                href="/"
                className="px-12 bg-primary-blue text-white font-semibold py-3"
              >
                <StringLang string="Go Back!" />
              </Link>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

export default Page;
