import React from "react";
import ProfileTab from "@/components/Sections/Profile/ProfileTab";
export function generateMetadata() {
  return {
    title: "Profile",
  };
}
function Page() {
  return <ProfileTab />;
}

export default Page;
