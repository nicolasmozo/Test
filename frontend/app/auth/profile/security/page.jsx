import SecurityTab from "@/components/Sections/Profile/SecurityTab";
import React from "react";
export function generateMetadata() {
  return {
    title: "security",
  };
}
function Page() {
  return <SecurityTab />;
}

export default Page;
