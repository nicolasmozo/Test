import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import SignIn from "@/components/Containers/SignIn";
export function generateMetadata() {
  return {
    title: "Sign In",
  };
}
function Page() {
  return (
    <>
      <PageTitleArea
        title="Signin"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "Signin", path: "/auth/signin" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="w-full lg:px-[183px]">
            <SignIn />
          </div>
        </div>
      </div>
    </>
  );
}

export default Page;
