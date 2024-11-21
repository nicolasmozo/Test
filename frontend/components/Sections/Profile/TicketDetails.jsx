"use client";
import MiniSvgLoader from "@/components/Helper/Loader/SvgLoader";
import { useSendMessageMutation } from "@/store/features/supportTickets/apiSlice";
import {
  useGetSingleTicketDataQuery,
  useLazyGetSingleTicketDataQuery,
} from "@/store/features/supportTickets/apiSlice";
import StringLang from "@/utilities/StringLang";
import { useRouter } from "next/navigation";
import React, { useState, useEffect, useRef } from "react";
import ReactTimeAgo from "react-time-ago";

function SupportMessages({
  messages,
  ticketStatusHandler,
  ticketStatus,
  ticketID,
  timeAgoHandler,
}) {
  const [inputMessage, setInputMessage] = useState("");
  const [newMessages, setNewMessages] = useState(messages);
  const messageRef = useRef(null);
  const fixedScrollBottom = () => {
    const messages = messageRef.current;
    if (messages) {
      messages.scrollTop = messages.scrollHeight;
    }
  };
  // 5000ms timeout API request
  const [getSingleTicketData] = useLazyGetSingleTicketDataQuery();
  useEffect(() => {
    setInterval(async () => {
      const results = await getSingleTicketData({ ticketID });
      if (results.status === "fulfilled") {
        setNewMessages(results?.data?.messages);
        ticketStatusHandler((prev) => ({
          ...prev,
          status: results?.data?.ticket?.status,
        }));
        fixedScrollBottom();
      }
    }, 10000);
  }, []);

  useEffect(() => {
    if (newMessages && newMessages.length > 0) {
      fixedScrollBottom();
    }
  });
  // send messages
  const [sendMessage] = useSendMessageMutation();
  const actionAfterSendMessage = async (ticketID) => {
    const results = await getSingleTicketData({ ticketID });
    if (results.status === "fulfilled") {
      setNewMessages(results?.data?.messages);
      ticketStatusHandler((prev) => ({
        ...prev,
        status: results?.data?.ticket?.status,
      }));
      fixedScrollBottom();
    }
  };
  const sendMessageHandler = () => {
    if (inputMessage !== "") {
      sendMessage({
        message: inputMessage,
        ticketID: ticketID,
        reset: () => setInputMessage(""),
        handler: () => actionAfterSendMessage(ticketID),
      });
      fixedScrollBottom();
    }
  };
  return (
    <div className="flex flex-col space-y-[20px]">
      <div
        ref={messageRef}
        className="w-full  h-[300px] overflow-y-auto overflow-style-none"
      >
        {newMessages &&
          newMessages.length > 0 &&
          newMessages.map((message, i) => (
            <>
              {message.message_from === "client" ? (
                <>
                  {/* send */}
                  <div
                    key={i}
                    className="w-full ltr:pl-[100px] rtl:pr-[100px] flex flex-col items-end"
                  >
                    <div className="w-fit py-[14px] px-3 bg-[#11261E] rounded-md">
                      <p className="text-base leading-[22px] text-white">
                        {message?.message}
                      </p>
                    </div>
                    <p className="text-sm text-white/20 text-end mt-1.5">
                      <ReactTimeAgo
                        date={timeAgoHandler(new Date(message?.created_at))}
                        locale="en-US"
                      />
                    </p>
                  </div>
                </>
              ) : (
                <>
                  {/* upcoming */}
                  <div
                    key={i}
                    className="w-full ltr:pr-[100px] rtl:pl-[100px] flex flex-col items-start"
                  >
                    <div className="w-fit py-[14px] px-3 bg-[#0B0E12] rounded-md">
                      <p className="text-base leading-[22px] text-white">
                        {message?.message}
                      </p>
                    </div>
                    <p className="text-sm text-white/20 text-start mt-1.5">
                      <ReactTimeAgo
                        date={timeAgoHandler(new Date(message?.created_at))}
                        locale="en-US"
                      />
                    </p>
                  </div>
                </>
              )}
            </>
          ))}
      </div>
      {ticketStatus !== "closed" ? (
        <>
          <div className="w-full">
            <textarea
              value={inputMessage}
              onChange={(e) => setInputMessage(e.target.value)}
              placeholder="Type Here..."
              className="w-full h-[156px] bg-[#0B0E12] border border-primary-blue resize-none p-4 placeholder:text-lg focus:outline-none text-lg text-white rounded"
            ></textarea>
          </div>
          <div className="flex justify-end">
            <button onClick={sendMessageHandler} type="button">
              <div className="py-4 px-8 flex rtl:space-x-reverse space-x-2.5 items-center bg-primary-blue common-transition rounded-[5px]">
                <span className="text-primary-black text-base font-medium leading-5">
                  <StringLang string="Send Message" />
                </span>
              </div>
            </button>
          </div>
        </>
      ) : (
        <div className="flex justify-center">
          <p className="py-1 px-2 bg-red-600/20 text-red-600 text-lg font-medium rounded w-full text-center">
            <StringLang string={"You ticket is closed"} />
          </p>
        </div>
      )}
    </div>
  );
}
function TicketDetails({ ticketID }) {
  const [ticketDetails, setTicketDetails] = useState(null);
  const { data, isFetching } = useGetSingleTicketDataQuery(
    { ticketID },
    {
      skip: ticketDetails,
    }
  );
  useEffect(() => {
    if (!isFetching && data) {
      setTicketDetails(data?.ticket);
    }
  }, [data, isFetching]);
  // real date time hanlder
  const timeAgoHandler = (time) => {
    return new Date(time).getTime();
  };
  // go back handler
  const router = useRouter();
  const goBackHandler = () => {
    router.back();
  };
  return (
    <div className="w-full flex xl:flex-row flex-col-reverse gap-[30px]">
      <div className="flex-1 bg-black p-6 rounded-xl">
        <button
          onClick={goBackHandler}
          type="button"
          className="py-3 px-4 rounded-md flex space-x-[6px] items-center bg-primary-yellow mb-[30px]"
        >
          <span>
            <svg
              width="14"
              height="10"
              viewBox="0 0 14 10"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M5 1L1 5M1 5L5 9M1 5L13 5"
                stroke="#121313"
                strokeWidth="1.5"
                strokeLinecap="round"
                strokeLinejoin="round"
              />
            </svg>
          </span>
          <span className="text-base font-semibold text-[#121313]">
            <StringLang string={"Go Back"} />
          </span>
        </button>
        {!isFetching ? (
          <SupportMessages
            ticketID={ticketID}
            messages={data?.messages}
            ticketStatus={ticketDetails?.status}
            ticketStatusHandler={setTicketDetails}
            timeAgoHandler={timeAgoHandler}
          />
        ) : (
          <div className="w-full flex justify-center">
            <MiniSvgLoader />
          </div>
        )}
      </div>
      <div className="xl:w-[318px] w-full">
        <div className="w-full p-6 bg-black">
          <p className="text-2xl font-semibold text-white pb-5 border-b border-[#202020]">
            <StringLang string={"Ticket information"} />
          </p>
          {!isFetching ? (
            <>
              {ticketDetails && (
                <>
                  <div className="w-full py-5">
                    <ul>
                      <li className="text-base text-white font-medium leading-[30px]">
                        <StringLang string={"Ticket Id"} />: #
                        {ticketDetails?.ticket_id}{" "}
                      </li>
                      <li className="text-base text-white font-medium leading-[30px]">
                        <StringLang string={"Created"} /> :{" "}
                        <ReactTimeAgo
                          date={timeAgoHandler(
                            new Date(ticketDetails?.created_at)
                          )}
                          locale="en-US"
                        />
                      </li>
                    </ul>
                  </div>
                  <div className="w-full pt-5 border-t border-[#202020] flex space-x-4 rtl:space-x-reverse items-center">
                    <span className="text-lg font-semibold text-white">
                      <StringLang string={"Status"} />
                    </span>
                    {ticketDetails?.status === "in_progress" ? (
                      <div className="bg-primary-blue/20 text-primary-blue px-4 py-1.5 text-lg font-medium inline-flex rounded-md">
                        <StringLang string={"In Progress"} />
                      </div>
                    ) : ticketDetails?.status === "pending" ? (
                      <div className="bg-blue-600/20 text-blue-600 px-4 py-1.5 text-lg font-medium inline-flex rounded-md">
                        <StringLang string={"Pending"} />
                      </div>
                    ) : ticketDetails?.status === "closed" ? (
                      <div className="bg-red-600/20 text-red-600 px-4 py-1.5 text-lg font-medium inline-flex rounded-md">
                        <StringLang string={"Closed"} />
                      </div>
                    ) : (
                      ""
                    )}
                  </div>
                </>
              )}
            </>
          ) : (
            <div className="w-full flex justify-center">
              <MiniSvgLoader />
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

export default TicketDetails;
