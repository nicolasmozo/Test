"use client";
import React from "react";
import BreadcrumbCom from "@/components/Helper/BreadcrumbCom";

function PageTitleArea({ title, breadcrumb = [] }) {
  return (
    <div className="page-title-wrapper w-full md:h-[206px] h-[150px] flex justify-center items-center">
      <div>
        <h1 className="md:text-[42px] text-3xl font-bold md:leading-[56px] text-white text-center">
          {title}
        </h1>
        <div className="flex justify-center">
          <BreadcrumbCom paths={breadcrumb} />
        </div>
      </div>
    </div>
  );
}

export default PageTitleArea;
