import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import NewPassword from "@/components/Containers/NewPassword";
export function generateMetadata() {
  return {
    title: "New Password",
  };
}
function Page() {
  return (
    <>
      <PageTitleArea
        title="New Password"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "New Password", path: "/auth/new-password" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="w-full lg:px-[183px]">
            <NewPassword />
          </div>
        </div>
      </div>
    </>
  );
}

export default Page;
