import FavoritesTab from "@/components/Sections/Profile/FavoritesTab";
import React from "react";
export function generateMetadata() {
  return {
    title: "Favorites",
  };
}
function Page() {
  return <FavoritesTab />;
}

export default Page;
