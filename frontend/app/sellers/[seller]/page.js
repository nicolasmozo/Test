import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import SellerProfile from "@/components/Containers/SellerProfile";
import { notFound } from "next/navigation";
async function getData(ctx) {
  const res = await fetch(
    `${process.env.BASE_URL}api/author/${ctx.params.seller}?lang_code=en`,
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
    title: `Seller | ${data?.author.user_name}`,
  };
}
async function Page(ctx) {
  const data = await getData(ctx);
  return (
    <>
      <PageTitleArea
        title={data?.author.name}
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "seller", path: "/seller" },
          {
            name: data?.author.name,
            path: `/seller/${data?.author.user_name}`,
          },
        ]}
      />
      <SellerProfile datas={data} />
    </>
  );
}

export default Page;
