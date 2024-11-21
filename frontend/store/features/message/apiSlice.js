import { apiSlice } from "@/store/api/apiSlice";

export const messageApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    getMessage: builder.query({
      query: ({ id }) => {
        return {
          url: `user/get-message-list/${id}`,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
      forceRefetch({ currentArg, previousArg }) {
        return currentArg !== previousArg;
      },
    }),
    sendMessage: builder.mutation({
      query: ({ message, id, resetForm }) => {
        const bodyFormData = new FormData();
        bodyFormData.append("message", message);
        return {
          url: `user/send-message/${id}`,
          method: "POST",
          body: bodyFormData,
        };
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        try {
          const { data, meta } = await queryFulfilled;
          if (meta.response.status === 200) {
            dispatch(
              apiSlice.util.updateQueryData(
                "getMessage",
                undefined,
                (draft) => {
                  const oldData = JSON.parse(JSON.stringify(draft));
                  oldData.messages.push(data.new_message);
                  return (draft = oldData);
                }
              )
            );
            resetForm();
          }
        } catch ({ error }) {}
      },
    }),
  }),
});

export const { useSendMessageMutation, useGetMessageQuery } = messageApi;
