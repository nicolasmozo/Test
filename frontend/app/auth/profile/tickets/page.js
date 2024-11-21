import Tickets from "@/components/Sections/Profile/Tickets";
import React from "react";
export function generateMetadata() {
  return {
    title: "Tickets",
  };
}
function Page() {
  return <Tickets />;
}

export default Page;
