"use client";
import React, { useState } from "react";
import BlogCard from "@/components/Common/Card/BlogCard";
import PaginateObserver from "@/components/Helper/PaginateObserver";
import { useBlogsQuery } from "@/store/features/blogs/apiSlice";

function Index({ blogs }) {
  const [storeBlogs, setStoreBlogs] = useState(blogs.data);
  const [lastPage, setLastPage] = useState(blogs?.last_page);
  const [page, setPage] = useState(2);

  const handlePage = (e) => {
    setPage((prev) => prev + 1);
  };
  const { data, isFetching } = useBlogsQuery({
    page: page,
  });

  if (storeBlogs && storeBlogs.length > 0) {
    return (
      <div className="w-full">
        <div className="theme-container mx-auto">
          <PaginateObserver
            handler={handlePage}
            lastPage={lastPage}
            loading={isFetching}
            currentPage={page}
          >
            <div className="w-full grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-[30px]">
              {storeBlogs.map((item, i) => (
                <BlogCard datas={item} key={i} />
              ))}
              {data?.blogs?.data?.map((item, i) => (
                <BlogCard datas={item} key={i} />
              ))}
            </div>
          </PaginateObserver>
        </div>
      </div>
    );
  }
}

export default Index;
