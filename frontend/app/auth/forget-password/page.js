import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import ForgetPassword from "@/components/Containers/ForgetPassword";
export function generateMetadata() {
  return {
    title: "Forget Password",
  };
}
function Page() {
  return (
    <>
      <PageTitleArea
        title="Signup"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "Forget Password", path: "/auth/forget-password" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="w-full lg:px-[183px]">
            <ForgetPassword />
          </div>
        </div>
      </div>
    </>
  );
}

export default Page;
