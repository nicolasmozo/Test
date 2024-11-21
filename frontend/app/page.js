import Hero from "@/components/Sections/Homepage/Hero";
import Categories from "@/components/Sections/Homepage/Categories";
import GiftCards from "@/components/Sections/Homepage/GiftCards";
import BestSellingProduct from "@/components/Sections/Homepage/BestSellingProduct";
import SliderProducts from "@/components/Sections/Homepage/SliderProducts";
import CounterSection from "@/components/Sections/Homepage/CounterSection";
import RecommendedProduct from "@/components/Sections/Homepage/RecommendedProduct";
import { notFound } from "next/navigation";

async function getData() {
  const res = await fetch(`${process.env.BASE_URL}api?lang_code=en`, {
    cache: "no-store",
  });
  if (!res.ok) {
    notFound();
  } else {
    return res?.json();
  }
}
export async function generateMetadata() {
  const { seo_setting } = await getData();
  return {
    title: seo_setting?.seo_title,
    description: seo_setting?.seo_description,
  };
}
export default async function Home() {
  const data = await getData();
  return (
    <>
      <Hero datas={data?.slider_banners} />
      <Categories datas={data?.categories} />
      <BestSellingProduct datas={data?.trending} />
      <SliderProducts
        datas={data?.category_three}
        title={data?.category_three?.category?.name}
        tag="Unlimited Offer"
        url={`/products?category=${data?.category_three?.category?.slug}`}
        className="bg-black pb-[60px]"
      />
      <GiftCards datas={data?.category_one} />
      <SliderProducts
        datas={data?.category_four}
        title={data?.category_four?.category?.name}
        tag="Unlimited Offer"
        url={`/products?category=${data?.category_four?.category?.slug}`}
        cardStyle="bg-black"
      />
      <CounterSection datas={data?.counter} />
      <RecommendedProduct
        cardStyle="bg-black"
        datas={data?.recommend_products}
      />
    </>
  );
}
