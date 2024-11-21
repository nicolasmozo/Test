import TestimonialSlider from "@/components/Sections/About/TestimonialSlider";
import React from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import { notFound } from "next/navigation";
import StringLang from "@/utilities/StringLang";
async function getData() {
  const res = await fetch(`${process.env.BASE_URL}api/about-us?lang_code=en`, {
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
  const { about_us, counter, testimonials } = await getData();
  return (
    <>
      <PageTitleArea
        title="About us"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "About us", path: "/about" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="w-full">
            {/*about*/}
            <div className="w-full grid lg:grid-cols-2 grid-cols-1 items-center gap-10 mb-[60px]">
              <div className="w-full">
                <div className="border-b border-[#23262B]">
                  <p className="text-xl text-primary-blue mb-2.5">
                    {about_us.title}
                  </p>
                  <h2 className="text-[24px] font-bold leading-[34px] text-white mb-3.5">
                    {about_us.header}
                  </h2>
                  <div
                    dangerouslySetInnerHTML={{ __html: about_us.about_us }}
                    className="mb-[30px]"
                  ></div>
                </div>
                <div className="flex rtl:space-x-reverse space-x-6 items-center mt-[30px]">
                  <div
                    style={{
                      boxShadow: "0px 0px 25px 0px rgba(0, 0, 0, 0.15)",
                    }}
                    className="w-[72px] h-[72px] rounded-full border-[5px] border-white overflow-hidden"
                  >
                    {/* admin image */}
                    <img
                      src={process.env.BASE_URL + about_us.owner_image}
                      alt=""
                      className="w-full h-full object-cover"
                    />
                  </div>
                  <div>
                    <h3 className="text-xl font-bold text-white">
                      {about_us.name}
                    </h3>
                    <p className="text-base">{about_us.designation}</p>
                  </div>
                </div>
              </div>
              <div>
                <img
                  src={`${process.env.BASE_URL + about_us.about_image}`}
                  alt=""
                />
              </div>
            </div>
            {/* testimonial */}
            <div className=" mb-[60px]">
              <TestimonialSlider datas={testimonials} />
            </div>
            {/* become seller */}
            <div
              style={{
                backgroundImage: "url(/assets/img/about-become-thumb.webp)",
              }}
              className="w-full md:px-[50px] p-8 md:py-[60px] rounded-lg bg-cover bg-no-repeat bg-center relative overflow-hidden"
            >
              <div className="w-full h-full bg-black bg-opacity-30 absolute left-0 top-0 z-10"></div>
              <div className="relative z-10">
                <p className="md:text-[42px] text-3xl font-medium text-white md:leading-[56px]">
                  <StringLang string="Become Seller" />
                </p>
                <p className="md:text-xl text-base md:leading-8 text-white mb-8">
                  <StringLang string="Sell your game and software licence easy way" />
                </p>
                <a href="/auth/become-seller">
                  <div className="lg:px-5 lg:py-2.5 px-4 py-2 rounded-[5px] bg-[#FFB321]  hover:bg-white hover:text-black  common-transition inline-flex">
                    <span className="text-base font-semibold text-black">
                      <StringLang string="Become Seller" />
                    </span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

export default Page;
