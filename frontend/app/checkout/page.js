import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import CheckoutContain from "@/components/Containers/CheckoutContain";
export function generateMetadata() {
  return {
    title: "Checkout",
  };
}
function Page() {
  return (
    <>
      <PageTitleArea
        title="Checkout"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "Checkout", path: "/checkout" },
        ]}
      />
      <CheckoutContain />
    </>
  );
}

export default Page;
