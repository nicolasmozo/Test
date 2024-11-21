import { apiSlice } from "@/store/api/apiSlice";
import { toast } from "react-toastify";

export const supportTickets = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    getTickets: builder.query({
      query: ({ page }) => {
        return {
          url: `/user/ticket-list?lang_code=en&page=${page}`,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
      merge: (currentCache, newItems) => {
        if (newItems?.tickets?.current_page > 1) {
          currentCache.tickets.data.push(...newItems.tickets.data);
          currentCache.tickets.current_page = newItems.tickets.current_page;
          currentCache.tickets.last_page = newItems.tickets.last_page;
        } else {
          currentCache.tickets.data = newItems.tickets.data;
          currentCache.tickets.current_page = newItems.tickets.current_page;
          currentCache.tickets.last_page = newItems.tickets.last_page;
        }
      },
      forceRefetch({ currentArg, previousArg }) {
        return currentArg?.page !== previousArg?.page;
      },
    }),
    getDataForCreateTicket: builder.query({
      query: () => {
        return {
          url: `/user/create-ticket?lang_code=en`,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
    }),
    createTicket: builder.mutation({
      query: (sendData) => {
        const bodyFormData = new FormData();
        Object.entries({
          order_id: sendData.order_id,
          subject: sendData.subject,
          message: sendData.message,
        }).map(([key, value]) => {
          bodyFormData.append(`${key}`, value);
        });
        return {
          url: `/user/ticket-request?lang_code=en`,
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const { data, meta } = await queryFulfilled;
          if (meta.response.status === 200) {
            toast.update(id, {
              render: data?.message,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
            dispatch(
              apiSlice.util.updateQueryData(
                "getTickets",
                undefined,
                (draft) => {
                  const oldData = JSON.parse(JSON.stringify(draft));
                  oldData.tickets.data.unshift(data?.ticket);
                  return (draft = oldData);
                }
              )
            );
            info.reset();
            info.modalCloseHandler();
          } else if (data.message) {
            toast.update(id, {
              render: data?.message,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          if (error.status === 422) {
            info.errors(error?.data?.errors);
            toast.update(id, {
              render: error?.data?.message,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          } else {
            toast.update(id, {
              render: error?.data?.message,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        }
      },
    }),
    getSingleTicketData: builder.query({
      query: ({ ticketID }) => {
        return {
          url: `/user/show-ticket/${ticketID}?lang_code=en`,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
      forceRefetch({ currentArg, previousArg }) {
        return currentArg?.ticketID !== previousArg?.ticketID;
      },
    }),
    sendMessage: builder.mutation({
      query: ({ ticketID, message, reset, handler }) => {
        const bodyFormData = new FormData();
        bodyFormData.append("message", message);
        bodyFormData.append("ticket_id", ticketID);
        return {
          url: `/user/send-ticket-message?lang_code=en`,
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
      async onQueryStarted(info, { queryFulfilled }) {
        try {
          const { data, meta } = await queryFulfilled;
          if (meta.response.status === 200) {
            info.reset();
            info.handler();
          }
        } catch (error) {
          console.log(error);
        }
      },
    }),
  }),
});

export const {
  useGetTicketsQuery,
  useGetDataForCreateTicketQuery,
  useCreateTicketMutation,
  useGetSingleTicketDataQuery,
  useLazyGetSingleTicketDataQuery,
  useSendMessageMutation,
} = supportTickets;
