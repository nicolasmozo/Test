import OrderTab from "@/components/Sections/Profile/OrderTab";
import React from "react";
export function generateMetadata() {
  return {
    title: "Orders",
  };
}
function Page() {
  return <OrderTab />;
}

export default Page;
