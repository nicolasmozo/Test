import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import BlogsContain from "@/components/Containers/BlogsContain";
import { notFound } from "next/navigation";
async function getData() {
  const res = await fetch(`${process.env.BASE_URL}api/blogs?lang_code=en`, {
    cache: "no-store",
  });
  if (res.ok) {
    return res?.json();
  } else {
    notFound();
  }
}
export async function generateMetadata() {
  const { seo_setting } = await getData();
  return {
    title: seo_setting?.seo_title,
    description: seo_setting?.seo_description,
  };
}
async function Page() {
  const { blogs } = await getData();
  return (
    <>
      <PageTitleArea
        title="Blogs"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "blogs", path: "/blogs" },
        ]}
      />
      <div className="w-full  py-[60px]">
        <BlogsContain blogs={blogs} />
      </div>
    </>
  );
}

export default Page;
