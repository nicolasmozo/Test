import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import { notFound } from "next/navigation";
async function getData() {
  const res = await fetch(
    `${process.env.BASE_URL}api/privacy-policy?lang_code=en`,
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
  return {
    title: "Privacy Policy",
  };
}
async function Page() {
  const data = await getData();
  return (
    <>
      <PageTitleArea
        title="Privacy Policy"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "Privacy Policy", path: "/privacy-policy" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div
            dangerouslySetInnerHTML={{ __html: data?.privacy_policy }}
            className="page-content-wrapper w-full"
          ></div>
        </div>
      </div>
    </>
  );
}

export default Page;
