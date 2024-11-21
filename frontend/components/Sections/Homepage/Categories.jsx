import React from "react";
import Link from "next/link";

function Categories({ datas }) {
  if (datas && datas.length > 0) {
    return (
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="grid xl:grid-cols-8 lg:grid-cols-6 sm:grid-cols-5 grid-cols-4 sm:gap-5 gap-3">
            {datas.map((category, i) => (
              <Link
                key={i}
                href={`/products?category=${category.slug}`}
                className="categories-item w-full sm:h-[142px] h-[100px] flex justify-center items-center p-2 rounded-[5px] bg-black border border-primary-border hover:shadow-lg hover:border-primary-blue hover:shadow-primary-blue common-transition group"
              >
                <div className="flex flex-col space-y-2 items-center">
                  <div>
                    <img
                      src={process.env.BASE_URL + category.icon}
                      alt=""
                      className="transform scale-100 group-hover:scale-105 common-transition"
                    />
                  </div>
                  <p className="text-sm text-center font-semibold text-white common-transition">
                    {category.name}
                  </p>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </div>
    );
  }
}

export default Categories;
