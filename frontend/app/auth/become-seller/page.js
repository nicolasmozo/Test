import React from "react";
import BecomeSellerContain from "@/components/Containers/BecomeSellerContain";
export function generateMetadata() {
  return {
    title: "Become Seller",
  };
}
function Page() {
  return (
    <>
      <BecomeSellerContain />
    </>
  );
}

export default Page;
