import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import ProductsContain from "@/components/Containers/ProductsContain";
import { notFound } from "next/navigation";
async function getData(ctx) {
  const res = await fetch(
    `${process.env.BASE_URL}api/products?lang_code=en${
      ctx.searchParams ? `&${ctx.searchParams.category}` : ""
    } ${ctx.searchParams.search ? `&${ctx.searchParams.search}` : ""}`,
    {
      cache: "no-store",
    }
  );
  if (res.ok) {
    return res?.json();
  } else {
    notFound();
  }
}
export async function generateMetadata(ctx) {
  const { seo_setting } = await getData(ctx);
  return {
    title: seo_setting?.seo_title,
    description: seo_setting?.seo_description,
  };
}
async function Page(ctx) {
  const { categories, max_price } = await getData(ctx);
  return (
    <>
      <PageTitleArea
        title="Products Page"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "products", path: "/products" },
        ]}
      />
      <div className="w-full mt-6 pb-[100px]">
        <ProductsContain
          categories={categories}
          max_price={max_price}
          searchKey={ctx.searchParams.search ? ctx.searchParams.search : null}
        />
      </div>
    </>
  );
}

export default Page;
