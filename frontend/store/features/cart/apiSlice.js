import { toast } from "react-toastify";
import { apiSlice } from "../../api/apiSlice";

export const cartApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    getCart: builder.query({
      query: () => {
        return {
          url: "user/cart-items",
        };
      },
      providesTags: ["cartData"],
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
    }),
    deleteCart: builder.mutation({
      query: ({ product }) => {
        return {
          url: `user/cart-remove/${product.id}`,
          method: "DELETE",
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
              apiSlice.util.updateQueryData("getCart", undefined, (draft) => {
                const oldData = JSON.parse(JSON.stringify(draft));

                oldData.items = oldData.items.filter(
                  (product) => product.id !== info.product.id
                );
                return (draft = oldData);
              })
            );
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
    addCart: builder.mutation({
      query: ({ product, item_type, activePayment, closeHandler }) => {
        const bodyFormData = new FormData();
        Object.entries(product).map(([key, value]) => {
          bodyFormData.append(`${key}`, value);
        });
        bodyFormData.append("item_type", item_type || "add_to_cart");
        return {
          url: `user/add-to-cart`,
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
            if (info.item_type === "add_to_cart" || !info.item_type) {
              dispatch(
                apiSlice.util.updateQueryData("getCart", undefined, (draft) => {
                  const oldData = JSON.parse(JSON.stringify(draft));
                  oldData.items = data.items;
                  return (draft = oldData);
                })
              );
              info.closeHandler();
            } else {
              info.activePayment();
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
          if (error?.data?.message) {
            toast.update(id, {
              render: `${error.data.message}`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          } else {
            toast.update(id, {
              render: "Some error hear",
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        }
      },
    }),
    updateQty: builder.mutation({
      query: ({ productId, qty }) => {
        return {
          url: `user/cart-item-increment/${productId}`,
          method: "PUT",
          body: { qty },
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
              apiSlice.util.updateQueryData("getCart", undefined, (draft) => {
                const oldData = JSON.parse(JSON.stringify(draft));
                oldData.items = oldData.items.map((item) => {
                  if (parseInt(item.id) === parseInt(info.productId)) {
                    item.qty = info.qty;
                  }
                  return item;
                });
                return (draft = oldData);
              })
            );
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
            render: "Something went to wrong. ",
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
  useAddCartMutation,
  useGetCartQuery,
  useLazyGetCartQuery,
  useDeleteCartMutation,
  useUpdateQtyMutation,
} = cartApi;
