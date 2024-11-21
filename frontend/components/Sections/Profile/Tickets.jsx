"use client";
import React, { useEffect, useState } from "react";
import Modal from "@/components/Helper/Modal";
import StringLang from "@/utilities/StringLang";
import PaginateObserver from "@/components/Helper/PaginateObserver";
import {
  useCreateTicketMutation,
  useGetDataForCreateTicketQuery,
  useGetTicketsQuery,
} from "@/store/features/supportTickets/apiSlice";
import ReactTimeAgo from "react-time-ago";
import MiniSvgLoader from "@/components/Helper/Loader/SvgLoader";
// create ticket modal component
function CreateTicketModal({ modalHandler }) {
  const { data, isFetching } = useGetDataForCreateTicketQuery();
  // submit ticket states
  const [ticketInfo, setTicketInfo] = useState({
    order_id: "",
    subject: "",
    message: "",
  });
  // store errors from server
  const [errors, setErrors] = useState(null);
  // reset form
  const resetHandler = () => {
    setTicketInfo(ticketInfo);
  };
  // input & selectbox handler
  const inputHandler = (e) => {
    setTicketInfo({ ...ticketInfo, [e.target.name]: e.target.value });
  };
  const selectHandler = (e) => {
    setTicketInfo({
      ...ticketInfo,
      order_id: e.target.value,
    });
  };
  // data send request
  const [createTicket, isLoading] = useCreateTicketMutation();
  // form submit handler
  const submitTicketHandler = async () => {
    await createTicket({
      ...ticketInfo,
      reset: resetHandler,
      modalCloseHandler: modalHandler,
      errors: setErrors,
    });
  };
  return (
    <div className="w-full h-screen fixed left-0 top-0  flex justify-center items-center">
      <div
        onClick={() => modalHandler(false)}
        className="w-full h-full fixed left-0 top-0 bg-black bg-opacity-50"
      ></div>
      <div
        data-aos="fade-up"
        className="w-[663px] min-h-[435px] bg-black rounded-[5px] p-[30px]"
      >
        <div className="flex justify-between items-center mb-5">
          <p className="text-[24px] font-semibold text-white leading-8 text-center">
            <StringLang string="Crate a New Ticket" />
          </p>
          <button
            onClick={() => modalHandler(false)}
            type="button"
            className="w-[30px] h-[30px] rounded-full flex justify-center items-center bg-[#F4D9E3]"
          >
            <span>
              <svg
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M5.31106 7.0172C3.67952 5.39415 2.1069 3.8281 0.532319 2.26429C0.142041 1.87678 -0.132922 1.45445 0.0761053 0.874029C0.423175 -0.0896932 1.44419 -0.290469 2.21857 0.474725C3.6582 1.89756 5.10343 3.31591 6.49845 4.78199C6.92772 5.23324 7.13395 5.15855 7.52114 4.75756C8.92653 3.30131 10.3648 1.8765 11.8038 0.453102C12.5675 -0.302544 13.6225 -0.0818314 13.9387 0.883014C14.1281 1.46091 13.8531 1.88352 13.4623 2.273C12.0434 3.68629 10.6324 5.10688 9.21384 6.52017C9.06065 6.67293 8.87575 6.79368 8.67177 6.95626C10.3347 8.61161 11.9304 10.185 13.5077 11.7766C14.2894 12.5653 14.063 13.6262 13.0706 13.9438C12.4814 14.1322 12.074 13.8175 11.6922 13.4347C10.2623 12.002 8.81599 10.5854 7.41256 9.12717C7.05763 8.75819 6.89574 8.81828 6.57617 9.14626C5.1486 10.6118 3.69299 12.0495 2.24635 13.4962C1.85803 13.8846 1.44222 14.1468 0.854979 13.907C-0.0925194 13.5198 -0.292289 12.5881 0.456564 11.8162C1.51741 10.723 2.60239 9.65311 3.68429 8.58016C4.20728 8.06123 4.74682 7.55831 5.31106 7.0172Z"
                  fill="#EB5757"
                />
              </svg>
            </span>
          </button>
        </div>
        {isFetching ? (
          <div className="flex justify-center mt-10">
            <MiniSvgLoader />
          </div>
        ) : (
          <>
            <div className="grid md:grid-cols-2 grid-cols-1 gap-5 ">
              <div className="col-span-full w-full">
                <div className="input-field h-[50px] relative">
                  <label className="text-sm text-white bg-black bg-opacity-30 absolute left-3 w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center">
                    <StringLang string={"Select Order"} />*
                  </label>
                  <select
                    onChange={(e) => selectHandler(e)}
                    type="text"
                    name="order"
                    placeholder="Name"
                    className="w-full h-full text-white  rounded-[5px] bg-[#0B0E12] border border-[#23262B]  px-4 focus:outline-none"
                  >
                    <option>
                      {" "}
                      <StringLang string={"Select Order ID"} />
                    </option>
                    {data?.order_lists?.length > 0 &&
                      data?.order_lists.map((tid, i) => (
                        <option key={i} value={tid.order_id}>
                          <StringLang string={"Order ID"} /> #{tid.order_id}
                        </option>
                      ))}
                  </select>
                </div>
                {errors?.order_id
                  ? errors.order_id.map((item) => (
                      <p key={item} className="pt-1 px-2 text-red-500">
                        {item}
                      </p>
                    ))
                  : ""}
              </div>
              <div className="col-span-full w-full">
                <div className="input-field h-[50px] relative">
                  <label className="text-sm text-white bg-black bg-opacity-30 absolute left-3 w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center">
                    <StringLang string={"Subject"} />*
                  </label>
                  <input
                    onChange={(e) => inputHandler(e)}
                    value={ticketInfo.subject}
                    name="subject"
                    type="text"
                    placeholder="Subject"
                    className="w-full h-full text-white  rounded-[5px] bg-[#0B0E12] border border-[#23262B]  px-4 focus:outline-none"
                  />
                </div>
                {errors?.subject
                  ? errors.subject.map((item) => (
                      <p key={item} className="pt-1 px-2 text-red-500">
                        {item}
                      </p>
                    ))
                  : ""}
              </div>
              <div className="col-span-full w-full">
                <div className="input-field relative">
                  <label className="text-sm text-white bg-black bg-opacity-30 absolute left-3 w-fit -top-[9px]  flex px-[5px] h-fit items-center justify-center">
                    <StringLang string={"Write Message"} />*
                  </label>
                  <textarea
                    onChange={(e) => inputHandler(e)}
                    value={ticketInfo.message}
                    name="message"
                    placeholder="Write a Message"
                    className="w-full h-[84px] text-white rounded-[5px] bg-[#0B0E12] border border-[#23262B] p-4 focus:outline-none resize-none"
                  ></textarea>
                </div>
                {errors?.message
                  ? errors.message.map((item) => (
                      <p key={item} className="px-2 text-red-500">
                        {item}
                      </p>
                    ))
                  : ""}
              </div>
            </div>
            <button
              type="button"
              onClick={submitTicketHandler}
              className="w-full h-[52px] mt-[30px] rounded bg-primary-blue text-primary-black flex justify-center items-center text-[18px] font-semibold tracking-wider mb-3"
            >
              <StringLang string={"Submit"} />
            </button>
          </>
        )}
      </div>
    </div>
  );
}

// main component
function Tickets() {
  const [toggleModal, setToggleModal] = useState(false);
  const [page, setPage] = useState(1);
  const handlePage = (e) => {
    setPage((prev) => prev + 1);
  };
  // get all support tickets
  const { data, isFetching } = useGetTicketsQuery({ page });
  // real date time hanlder
  const timeAgoHandler = (time) => {
    return new Date(time).getTime();
  };

  return (
    <>
      <div className="w-full p-6 relative bg-black rounded-md">
        <div className="flex justify-between items-center gap-5 flex-wrap mb-6">
          <p className="text-[24px] font-semibold text-white leading-8">
            <StringLang string="Support Ticket" />
          </p>
          <button
            onClick={() => setToggleModal(true)}
            type="button"
            className="flex justify-center items-center py-3 px-4 bg-primary-blue text-primary-black rounded-md"
          >
            <div className="flex space-x-[6px] items-center">
              <span>
                <svg
                  width="14"
                  height="14"
                  viewBox="0 0 14 14"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M7 1V13M13 7L1 7"
                    stroke="currentColor"
                    strokeWidth="1.5"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  />
                </svg>
              </span>
              <span className="font-semibold text-base text-primary-black">
                <StringLang string={"Open New Ticket"} />
              </span>
            </div>
          </button>
        </div>
        <div className="w-full overflow-hidden rounded-md">
          <div className="w-full overflow-auto">
            <PaginateObserver
              handler={handlePage}
              lastPage={data?.tickets?.last_page}
              loading={isFetching}
              currentPage={page}
            >
              <table className="w-full ">
                <thead>
                  <tr>
                    <th className="bg-[#0B0E13] py-3 first:px-3 last:px-3 text-lg font-semibold text-start">
                      <StringLang string={"SN"} />
                    </th>
                    <th className="bg-[#0B0E13] py-3 first:px-3 last:px-3 text-lg font-semibold w-[288px] text-start">
                      <StringLang string={"Ticket Info"} />
                    </th>
                    <th className="bg-[#0B0E13] py-3 first:px-3 last:px-3 text-lg font-semibold text-start">
                      <StringLang string={"Unread Message"} />
                    </th>
                    <th className="bg-[#0B0E13] py-3 first:px-3 last:px-3 text-lg font-semibold text-start">
                      <StringLang string={"Status"} />
                    </th>
                    <th className="bg-[#0B0E13] py-3 first:px-3 last:px-3 text-lg font-semibold text-end ">
                      <StringLang string={"Action"} />
                    </th>
                  </tr>
                </thead>
                <tbody>
                  {data?.tickets?.data?.map((ticket, i) => (
                    <tr key={i}>
                      <td className="p-3 text-base font-semibold text-white">
                        {i + 1}
                      </td>
                      <td className="p-3 text-base font-medium w-[210px] inline-block">
                        <StringLang string={"Ticket Id"} />: #
                        {ticket?.ticket_id} <br />
                        <StringLang string={"Create"} />:{" "}
                        <ReactTimeAgo
                          date={timeAgoHandler(new Date(ticket?.updated_at))}
                          locale="en-US"
                        />
                      </td>
                      <td>
                        <div className="bg-primary-blue/20 px-3 py-1 rounded-md  text-primary-blue text-lg inline-flex">
                          {ticket?.unSeenUserMessage}
                        </div>
                      </td>
                      <td className="inline-block w-[150px]">
                        {ticket?.status === "in_progress" ? (
                          <div className="bg-primary-blue/20 text-primary-blue px-4 py-1.5 text-lg font-medium inline-flex rounded-md">
                            <StringLang string={"In Progress"} />
                          </div>
                        ) : ticket?.status === "pending" ? (
                          <div className="bg-blue-600/20 text-blue-600 px-4 py-1.5 text-lg font-medium inline-flex rounded-md">
                            <StringLang string={"Pending"} />
                          </div>
                        ) : ticket?.status === "closed" ? (
                          <div className="bg-red-600/20 text-red-600 px-4 py-1.5 text-lg font-medium inline-flex rounded-md">
                            <StringLang string={"Closed"} />
                          </div>
                        ) : (
                          ""
                        )}
                      </td>
                      <td>
                        <div className="flex justify-end pr-3">
                          <a
                            href={`/auth/profile/tickets/${ticket?.ticket_id}`}
                            className="w-[44px] h-[44px] rounded-md bg-primary-blue flex justify-center items-center"
                          >
                            <span>
                              <svg
                                width="22"
                                height="16"
                                viewBox="0 0 22 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M20.1303 5.8531C21.2899 7.07317 21.2899 8.92683 20.1303 10.1469C18.1745 12.2047 14.8155 15 11 15C7.18448 15 3.82549 12.2047 1.86971 10.1469C0.710098 8.92683 0.710098 7.07317 1.86971 5.8531C3.82549 3.79533 7.18448 1 11 1C14.8155 1 18.1745 3.79533 20.1303 5.8531Z"
                                  stroke="#121313"
                                  strokeWidth="1.5"
                                />
                                <path
                                  d="M14 8C14 9.65685 12.6569 11 11 11C9.34315 11 8 9.65685 8 8C8 6.34315 9.34315 5 11 5C12.6569 5 14 6.34315 14 8Z"
                                  stroke="#121313"
                                  strokeWidth="1.5"
                                />
                              </svg>
                            </span>
                          </a>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </PaginateObserver>
          </div>
        </div>
      </div>
      {toggleModal && (
        <Modal onClose={() => setToggleModal(false)}>
          <CreateTicketModal modalHandler={setToggleModal} />
        </Modal>
      )}
    </>
  );
}

export default Tickets;
