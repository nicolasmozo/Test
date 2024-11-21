import React from "react";
import ProductDetailsContainer from "@/components/Containers/ProductDetailsContainer";
import { notFound } from "next/navigation";
async function getData(ctx) {
  const res = await fetch(
    `${process.env.BASE_URL}api/product/${ctx.params.product}?lang_code=en`,
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
  const data = await getData(ctx);
  return {
    title: data?.product?.name,
    description: data?.product?.short_description,
  };
}
async function Page(ctx) {
  const data = await getData(ctx);
  return (
    <>
      <ProductDetailsContainer datas={data} />
    </>
  );
}

export default Page;
