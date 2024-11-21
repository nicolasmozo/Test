import { apiSlice } from "@/store/api/apiSlice";

export const productsApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    blogs: builder.query({
      query: ({ page, blogData }) => {
        return {
          url: `blogs?page=${page}`,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
      merge: (currentCache, newItems) => {
        if (newItems?.blogs?.current_page > 1) {
          currentCache.blogs.data.push(...newItems.blogs.data);
          currentCache.blogs.current_page = newItems.blogs.current_page;
        } else {
          currentCache.blogs.data = newItems.blogs.data;
          currentCache.blogs.current_page = newItems.blogs.current_page;
        }
      },
      forceRefetch({ currentArg, previousArg }) {
        return currentArg !== previousArg;
      },
    }),
  }),
});

export const { useBlogsQuery } = productsApi;
