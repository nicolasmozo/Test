import { apiSlice } from "@/store/api/apiSlice";
import { toast } from "react-toastify";

export const paymentApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    bankTransfer: builder.mutation({
      query: ({ formInfo }) => {
        const bodyFormData = new FormData();
        bodyFormData.append("tnx_info", formInfo.tnx_info);
        bodyFormData.append("account_id", formInfo.account_id);
        bodyFormData.append("message", formInfo.message);
        return {
          url: `user/bank-payment`,
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
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
          }
        } catch ({ error }) {
          toast.update(id, {
            render: `Something went to wrong`,
            type: "error",
            isLoading: false,
            autoClose: 2000,
          });
        }
      },
    }),
    paymentInfo: builder.query({
      query: () => {
        return {
          url: `user/payment`,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
    }),
  }),
});

export const { useBankTransferMutation, usePaymentInfoQuery } = paymentApi;
