import { toast } from "react-toastify";
import { apiSlice } from "../../api/apiSlice";

export const orderApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    getOrder: builder.query({
      query: ({ page }) => {
        return {
          url: `user/order-items?page=${page}`,
        };
      },
      providesTags: ["orderData"],
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
      merge: (currentCache, newItems) => {
        if (newItems?.items?.current_page > 1) {
          currentCache.items.data.push(...newItems.items.data);
          currentCache.items.current_page = newItems.items.current_page;
          currentCache.items.last_page = newItems.items.last_page;
        } else {
          currentCache.items.data = newItems.items.data;
          currentCache.items.current_page = newItems.items.current_page;
          currentCache.items.last_page = newItems.items.last_page;
        }
      },
      forceRefetch({ currentArg, previousArg }) {
        return currentArg !== previousArg;
      },
    }),
    approveOrder: builder.mutation({
      query: ({ orderId, reSet }) => {
        return {
          url: `user/make-item-approval/${orderId}`,
          method: "PUT",
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
            dispatch(
              apiSlice.util.updateQueryData("getOrder", undefined, (draft) => {
                const oldData = JSON.parse(JSON.stringify(draft));
                oldData.items.data = oldData.items.data.map((order) => {
                  if (parseInt(order.id) === parseInt(info.orderId)) {
                    return data.item;
                  } else {
                    return order;
                  }
                });
                return oldData;
              })
            );
            info.reSet();
          } else if (data.message) {
            toast.update(id, {
              render: data.message,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          toast.update(id, {
            render: "Some error hear",
            type: "error",
            isLoading: false,
            autoClose: 2000,
          });
        }
      },
    }),
    review: builder.mutation({
      query: ({ orderId, reviewInfo, resetForm, closeModal }) => {
        const bodyFormData = new FormData();
        Object.entries(reviewInfo).map(([key, value]) => {
          bodyFormData.append(`${key}`, value);
        });
        return {
          url: `user/make-review/${orderId}`,
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
              apiSlice.util.updateQueryData("getOrder", undefined, (draft) => {
                const oldData = JSON.parse(JSON.stringify(draft));
                oldData.items.data = oldData.items.data.map((order) => {
                  if (parseInt(order.id) === parseInt(info.orderId)) {
                    order.has_review = "yes";
                  }
                  return order;
                });
                return (draft = oldData);
              })
            );
            info.resetForm();
            info.closeModal();
          } else if (data.message) {
            toast.update(id, {
              render: `Something went to wrong`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          toast.update(id, {
            render: "Some error hear",
            type: "error",
            isLoading: false,
            autoClose: 2000,
          });
        }
      },
    }),
    checkOut: builder.mutation({
      query: ({ orderInfo, redirectToOrder, order_type }) => {
        const bodyFormData = new FormData();
        if (orderInfo) {
          Object.entries(orderInfo).map(([key, value]) => {
            bodyFormData.append(`${key}`, value);
          });
        }
        if (!!order_type) {
          bodyFormData.append("order_type", order_type);
        }
        return {
          url: "user/make-order",
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      invalidatesTags: ["cartData", "orderData"],
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
            if (info?.redirectToOrder) {
              info?.redirectToOrder();
            }
          } else if (data.message) {
            toast.update(id, {
              render: data.message,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          toast.update(id, {
            render: "Something went to wrong ",
            type: "error",
            isLoading: false,
            autoClose: 2000,
          });
        }
      },
    }),
  }),
});

export const {
  useGetOrderQuery,
  useReviewMutation,
  useApproveOrderMutation,
  useCheckOutMutation,
} = orderApi;
