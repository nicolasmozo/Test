"use client";
import AOS from "aos";
import React, { useEffect } from "react";

function AosInit() {
  useEffect(() => {
    AOS.init();
  }, []);
  return <></>;
}

export default AosInit;
