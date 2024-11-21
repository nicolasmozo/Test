import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import SignUp from "@/components/Containers/SignUp";
export function generateMetadata() {
  return {
    title: "Sign Up",
  };
}
function Page() {
  return (
    <>
      <PageTitleArea
        title="Signup"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "Signup", path: "/auth/signup" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="w-full lg:px-[183px]">
            <SignUp />
          </div>
        </div>
      </div>
    </>
  );
}

export default Page;
