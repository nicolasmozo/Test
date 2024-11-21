import {
  useGetMessageQuery,
  useSendMessageMutation,
} from "@/store/features/message/apiSlice";
import React, { useEffect, useState } from "react";
import ReactTimeAgo from "react-time-ago";
import StringLang from "@/utilities/StringLang";

function OrderChatBoard({ id, isApprove }) {
  const [message, setMessage] = useState();
  const [sendMessage, { isLoading }] = useSendMessageMutation();
  const { data, isFetching, refetch } = useGetMessageQuery({ id });
  const timeAgoHandler = (time) => {
    return new Date(time).getTime();
  };
  useEffect(() => {
    const intervalId = setInterval(() => {
      refetch();
    }, 5000);
    return clearInterval(intervalId);
  }, []);
  return (
    <>
      <div className="flex flex-col space-y-[20px]">
        {data?.messages.map((message) => {
          if (message.send_seller === 1) {
            return (
              <div
                key={message.id}
                className="w-full border border-[#23262B] px-5 py-7 rounded relative bg-black"
              >
                <p className="text-base font-semibold text-primary-black leading-8 ">
                  <span className="text-primary-blue">Author</span>
                </p>
                <p className="text-base text-[#616161] pt-8 ">
                  {message.message}
                </p>
                <span className="text-lg text-primary-blue absolute right-5 top-6">
                  <ReactTimeAgo
                    date={timeAgoHandler(new Date(message.created_at))}
                    locale="en-US"
                  />
                </span>
              </div>
            );
          } else {
            return (
              <div
                key={message.id}
                className="w-full border border-[#23262B] px-5 py-7 rounded relative bg-black"
              >
                <p
                  className="text-base text-gray-400 pt-8 "
                  dangerouslySetInnerHTML={{
                    __html: message.message.replace(/<[^>]*>/g, ""),
                  }}
                ></p>
                <span className="text-lg text-primary-blue absolute right-5 top-6">
                  <ReactTimeAgo
                    date={timeAgoHandler(new Date(message.created_at))}
                    locale="en-US"
                  />
                </span>
              </div>
            );
          }
        })}
      </div>
      <div className="w-full mb-[14px]">
        {!isApprove && (
          <textarea
            value={message}
            onChange={(e) => setMessage(e.target.value)}
            placeholder="Type Here..."
            className="w-full h-[156px] bg-[#0B0E12] border border-primary-blue resize-none p-4 placeholder:text-lg focus:outline-none text-lg mb-[14px] text-white rounded"
          ></textarea>
        )}
      </div>
      <div className="flex justify-end">
        {!isApprove && (
          <button
            onClick={() => {
              sendMessage({ message, id, resetForm: setMessage("") });
            }}
            type="button"
          >
            <div className="py-4 px-8 flex rtl:space-x-reverse space-x-2.5 items-center bg-primary-blue common-transition rounded-[5px]">
              <span className="text-primary-black text-base font-medium leading-5">
                <StringLang string="Send Message" />
              </span>
            </div>
          </button>
        )}
      </div>
    </>
  );
}

export default OrderChatBoard;
