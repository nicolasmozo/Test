import { apiSlice } from "@/store/api/apiSlice";
import { toast } from "react-toastify";

export const subscribeApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    sendEmail: builder.mutation({
      query: ({ data, handler }) => {
        return {
          url: `/newsletter-request?lang_code=en`,
          method: "POST",
          body: data,
        };
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const { data, meta } = await queryFulfilled;
          if (meta?.response?.status === 200) {
            info.handler("");
          }

          if (data?.message) {
            toast.update(id, {
              render: `${data?.message}`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          if (error?.data?.message) {
            toast.update(id, {
              render: `${error?.data?.message}`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          } else {
            toast.update(id, {
              render: `Error occurred!`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        }
      },
    }),
  }),
});

export const { useSendEmailMutation } = subscribeApi;
