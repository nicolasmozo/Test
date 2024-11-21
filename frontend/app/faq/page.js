import PageTitleArea from "@/components/Common/PageTitleArea";
import FaqContain from "@/components/Containers/FaqContain";
import React from "react";
async function getData() {
  const res = await fetch(`${process.env.BASE_URL}api/faq?lang_code=en`, {
    cache: "no-store",
  });
  if (res.ok) {
    return res?.json();
  } else {
    notFound();
  }
}
export function generateMetadata() {
  return {
    title: "FAQ",
  };
}
async function page() {
  const data = await getData();
  return (
    <>
      <PageTitleArea
        title="FAQ"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "FAQ", path: "/faq" },
        ]}
      />
      <FaqContain faqs={data?.faqs} testimonials={data?.testimonials} />
    </>
  );
}

export default page;
