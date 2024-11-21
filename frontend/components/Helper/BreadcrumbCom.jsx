"use client";
import React from "react";
import useLanguage from "@/hooks/useLanguage";

function BreadcrumbCom({ paths = [{ name: "home", path: "/" }] }) {
  const language = useLanguage();
  return (
    <div className="breadcrumb-main-wrapper">
      {paths && paths.length > 0 && (
        <div key={Math.random()}>
          <div className="breadcrumb-wrapper md:text-[18px] text-sm text-white mb-[26px] print:hidden">
            {paths.map((path) => (
              <span key={Math.random()}>
                <a href={path.path}>
                  <span className="mx-1 capitalize">{path.name}</span>
                </a>
                <span className="sperator">/</span>
              </span>
            ))}
          </div>
        </div>
      )}
      <style jsx>{`
        .breadcrumb-wrapper span:last-child .sperator {
          display: none;
        }
      `}</style>
    </div>
  );
}

export default BreadcrumbCom;
