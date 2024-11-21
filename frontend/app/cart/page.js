import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import CartContain from "@/components/Containers/CartContain";
export function generateMetadata() {
  return {
    title: "Cart",
  };
}
function Page() {
  return (
    <>
      <PageTitleArea
        title="Cart"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "Cart", path: "/cart" },
        ]}
      />
      <CartContain />
    </>
  );
}

export default Page;
