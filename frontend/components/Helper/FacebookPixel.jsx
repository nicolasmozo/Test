"use client";
import React, { useState, useEffect } from "react";
import { usePathname, useSearchParams } from "next/navigation";

function FacebookPixel({ data }) {
  const pathname = usePathname();
  const searchParams = useSearchParams();
  useEffect(() => {
    if (data) {
      import("react-facebook-pixel")
        .then((x) => x.default)
        .then((ReactPixel) => {
          ReactPixel.init(`${data.app_id}`); //don't forget to change this
          ReactPixel.pageView();
        });
    }
  }, [data, pathname, searchParams]);
  return null;
}

export default FacebookPixel;
