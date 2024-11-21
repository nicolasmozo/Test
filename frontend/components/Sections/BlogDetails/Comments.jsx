"use client";
import React, { useState } from "react";
import CommentForm from "./CommentForm";
import PaginateObserver from "@/components/Helper/PaginateObserver";
import { useGetCommentQuery } from "@/store/features/blogComment/apiSlice";
import ReactTimeAgo from "react-time-ago";
import TimeAgo from "javascript-time-ago";

import en from "javascript-time-ago/locale/en";

TimeAgo.addDefaultLocale(en);

function Comments({ blogId }) {
  const [page, setPage] = useState(1);
  const { data, isFetching } = useGetCommentQuery({ blogId, page });
  return (
    <div className="w-full mt-[60px]">
      {data?.comments?.data.length > 0 && (
        <div>
          <p className="text-xl font-bold mb-10">
            {data?.comments?.data.length} Comments
          </p>
          <div className="w-full flex flex-col space-y-5 mb-[60px]">
            <PaginateObserver
              type="onclick"
              handler={() => setPage((prev) => prev + 1)}
              currentPage={page}
              lastPage={data?.comments?.last_page}
              loading={isFetching}
            >
              {data?.comments?.data?.map((item, index) => (
                <div
                  key={item?.id || item?.name + index}
                  className="sm:flex sm:rtl:space-x-reverse space-x-10 py-5 border-b border-primary-border last:border-none"
                >
                  <div className="w-[120px] h-[120px] rounded-full overflow-hidden mb-5 sm:mb-0">
                    <img
                      src="/assets/img/comment-1.jpeg"
                      alt=""
                      className="w-full h-full object-cover object-center"
                    />
                  </div>
                  <div className="flex-1">
                    <h3 className="text-xl font-bold mb-2.5 text-white">
                      {item.name}
                    </h3>
                    <p
                      className="text-base"
                      dangerouslySetInnerHTML={{
                        __html: item.comment.replace(/<[^>]*>/g, ""),
                      }}
                    ></p>
                    <div className="flex justify-between items-center">
                      <span className="text-sm text-primary-blue">
                        <ReactTimeAgo date={new Date(item.created_at)} />
                      </span>
                    </div>
                  </div>
                </div>
              ))}
            </PaginateObserver>
          </div>
        </div>
      )}

      {/*comment box*/}
      <CommentForm blogId={blogId} />
    </div>
  );
}

export default Comments;
