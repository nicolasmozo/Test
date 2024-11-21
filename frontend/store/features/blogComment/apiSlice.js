import { toast } from "react-toastify";
import { apiSlice } from "../../api/apiSlice";

export const blogCommentApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    getComment: builder.query({
      query: ({ page, blogId }) => {
        return {
          url: `/blog-comment-list/${blogId}?lang_code=en&page=${page}`,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
      merge: (currentCache, newItems) => {
        if (newItems?.comments?.current_page > 1) {
          currentCache.comments.data.push(...newItems.comments.data);
          currentCache.comments.current_page = newItems.comments.current_page;
          currentCache.comments.last_page = newItems.comments.last_page;
        } else {
          currentCache.comments.data = newItems.comments.data;
          currentCache.comments.current_page = newItems.comments.current_page;
          currentCache.comments.last_page = newItems.comments.last_page;
        }
      },
      forceRefetch({ currentArg, previousArg }) {
        return currentArg !== previousArg;
      },
    }),
    submitComment: builder.mutation({
      query: ({ comment, blogId }) => {
        return {
          url: `store-blog-comment/${blogId}`,
          method: "POST",
          body: comment,
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
            info.resetForm();
            toast.update(id, {
              render: data?.message,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
            dispatch(
              apiSlice.util.updateQueryData(
                "getComment",
                undefined,
                (draft) => {
                  const oldData = JSON.parse(JSON.stringify(draft));
                  oldData.comments.data = [
                    { ...info.comment, created_at: new Date() },
                    ...oldData.comments.data,
                  ];
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
            render: error.data.message,
            type: "error",
            isLoading: false,
            autoClose: 2000,
          });
        }
      },
    }),
  }),
});

export const { useSubmitCommentMutation, useGetCommentQuery } = blogCommentApi;
