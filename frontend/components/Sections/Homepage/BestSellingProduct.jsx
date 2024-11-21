"use client";
import React, { useEffect, useState } from "react";
import ProductCard from "@/components/Common/Card/ProductCard";
import StringLang from "@/utilities/StringLang";
import { useSelector } from "react-redux";

function BestSellingProduct({ datas }) {
  const { settings } = useSelector((state) => state.defaultSettings);
  const [selectedCategory, setSelectedCategory] = useState(
    datas && datas?.categories && datas?.categories.length > 0
      ? datas?.categories[0].id
      : null
  );
  const [products, setProducts] = useState([]);
  useEffect(() => {
    if (selectedCategory) {
      const filterProducts =
        datas && datas?.products?.length > 0
          ? datas.products.filter(
              (item) =>
                parseInt(item.category_id) === parseInt(selectedCategory)
            )
          : [];
      setProducts(filterProducts);
    }
  }, [selectedCategory]);
  if (datas && datas?.products?.length > 0) {
    return (
      <div className="w-full py-[60px] relative">
        <div className="theme-container mx-auto relative z-10">
          <div className="w-full">
            <div className="title flex justify-between items-center w-full">
              <div>
                <p className="md:text-lg text-sm font-medium text-primary-blue">
                  <StringLang string="Top Much" />
                </p>
                <h2 className="md:text-[36px] md:leading-[56px] text-2xl font-medium text-white tracking-tight">
                  <StringLang string="Best Selling Products" />
                </h2>
              </div>
              {datas?.categories &&
                datas?.categories &&
                datas?.categories.length > 0 && (
                  <div className="lg:flex hidden rtl:space-x-reverse space-x-[14px] items-center">
                    {datas?.categories
                      .slice(
                        0,
                        datas.categories.length >= 3
                          ? 3
                          : datas?.categories.length
                      )
                      .map((category, i) => (
                        <button
                          onClick={() => setSelectedCategory(category.id)}
                          key={i}
                          type="button"
                        >
                          <div
                            className={`lg:py-4 lg:px-[25px] py-3 px-5 flex rtl:space-x-reverse space-x-2.5 items-center  hover:text-primary-black hover:bg-primary-blue common-transition rounded-[5px] border hover:border-transparent border-[#66676B] ${
                              selectedCategory === category.id
                                ? "bg-primary-blue text-primary-black border-transparent"
                                : "bg-transparent text-white"
                            }`}
                          >
                            <span className=" text-base font-medium leading-5">
                              {category.name}
                            </span>
                          </div>
                        </button>
                      ))}
                  </div>
                )}
            </div>
            <div className="w-full mt-[30px] lg:flex lg:rtl:space-x-reverse space-x-[30px] items-stretch">
              <div className="flex-1">
                {products.length > 0 ? (
                  <div className="w-full grid md:grid-cols-2 grid-cols-1 gap-6">
                    {products
                      .slice(0, products.length >= 6 ? 6 : products.length)
                      .map((product, i) => (
                        <ProductCard key={i} {...product} type="row" />
                      ))}
                  </div>
                ) : (
                  <div className="mt-5 flex justify-center items-center">
                    <span>
                      <StringLang string="No Products Found" />
                    </span>
                  </div>
                )}
              </div>
              {Number(settings?.homepage_ads?.status) === 1 && (
                <a href={settings?.homepage_ads?.link} target="_blank">
                  <div className="lg:w-[270px] bg-white p-[6px] rounded-lg lg:block hidden">
                    <img
                      src={process.env.BASE_URL + settings?.homepage_ads?.image}
                      alt=""
                      className="w-full h-full object-cover rounded-lg"
                    />
                  </div>
                </a>
              )}
            </div>
          </div>
        </div>
        <div className="absolute left-0 top-0 w-full h-full">
          <img
            src="/assets/img/best-selling-product-shape.png"
            alt=""
            className="w-full h-full object-cover"
          />
        </div>
      </div>
    );
  }
}

export default BestSellingProduct;
