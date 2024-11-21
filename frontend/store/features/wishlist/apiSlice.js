import { toast } from "react-toastify";
import { apiSlice } from "../../api/apiSlice";
// useRouter

export const wishlistApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    getWishList: builder.query({
      query: () => {
        return {
          url: "user/wishlist?lang_code=en",
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
    }),
    addWishList: builder.mutation({
      query: ({ product }) => {
        return {
          url: `user/add/wishlist/${product.id}`,
          method: "POST",
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
              apiSlice.util.updateQueryData(
                "getWishList",
                undefined,
                (draft) => {
                  const oldData = JSON.parse(JSON.stringify(draft));
                  oldData.products = [info.product, ...oldData.products];
                  return (draft = oldData);
                }
              )
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
    deleteWishList: builder.mutation({
      query: ({ product }) => {
        return {
          url: `user/delete/wishlist/${product.id}`,
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
              apiSlice.util.updateQueryData(
                "getWishList",
                undefined,
                (draft) => {
                  const oldData = JSON.parse(JSON.stringify(draft));
                  oldData.products = oldData.products.filter(
                    (product) => product.slug !== info.product.slug
                  );
                  return (draft = oldData);
                }
              )
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
  }),
});

export const {
  useGetWishListQuery,
  useLazyGetWishListQuery,
  useAddWishListMutation,
  useDeleteWishListMutation,
} = wishlistApi;
