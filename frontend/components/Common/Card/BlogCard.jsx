"use client";
import React from "react";
import Link from "next/link";
import DateFormat from "@/utilities/DateFormat";
import StringLang from "@/utilities/StringLang";

function BlogCard({ datas }) {
  const { created_at, slug, image, title, short_description, admin } = datas;
  return (
    <div
      style={{ boxShadow: "0px 4px 84px 0px rgba(0, 0, 0, 0.06)" }}
      className="w-full bg-black rounded-lg px-2 pt-2 group"
    >
      <div className="w-full h-[257px] relative mb-5">
        <div className="inline-block px-4 py-[9px] rounded bg-[#0B0E12] absolute ltr:right-3 ltr:left-auto rtl:left-3 rtl:right-auto -bottom-4 z-10">
          <span className="text-white text-base leading-none">
            {DateFormat(created_at)}
          </span>
        </div>
        <div className="w-full h-full rounded-[5px] overflow-hidden">
          <img
            src={process.env.BASE_URL + image}
            alt=""
            className="w-full h-full object-cover transform scale-100 group-hover:scale-110 common-transition"
          />
        </div>
      </div>
      <div className="px-2.5">
        <Link href={`/blogs/${slug}`}>
          <h2 className="text-white font-semibold text-xl mb-4 line-clamp-2">
            {title}
          </h2>
        </Link>
        <p className="mb-4 text-base line-clamp-2">{short_description}</p>
        <div className="flex justify-between py-[15px] border-t border-[#23262B]">
          <Link
            href={`/blogs/${slug}`}
            className="text-base text-white underline"
          >
            <StringLang string="Read More" />
          </Link>
          <div className="flex rtl:space-x-reverse space-x-2 items-center">
            <div className="w-[32px] h-[32px] rounded-full overflow-hidden">
              <img
                src={process.env.BASE_URL + admin.image}
                alt=""
                className="w-full h-full object-cover"
              />
            </div>
            <p className="text-sm text-white">
              <StringLang string="By" /> <b>{admin.name}</b>{" "}
            </p>
          </div>
        </div>
      </div>
    </div>
  );
}

export default BlogCard;
