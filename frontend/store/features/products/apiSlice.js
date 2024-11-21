import { apiSlice } from "../../api/apiSlice";

export const productsApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    shopPageInfo: builder.query({
      query: ({
        page,
        ratings,
        priceRange,
        category,
        currencyRate,
        sortby,
        searchKey
      }) => {
        const priceRangeData = `&min_price=${priceRange[0]}&max_price=${priceRange[1]}`;

        let queryData = "";

        if (priceRange[1]) {
          queryData += priceRangeData;
        }
        if(ratings && ratings.length>0){
          const ratingData = ratings.map((item)=>(`&ratings[]=${item}`)).join('');
          queryData += ratingData;
        }
        if(sortby){
          const sortByQuery = `&sorting=${sortby.slug}`;
          queryData += sortByQuery
        }
        if(searchKey){
          queryData+=`&keyword=${searchKey}`
        }
        return {
          url: `/products?lang_code=en&page=${page}${category?`&category=${category}`:''}&currency_rate=${currencyRate}${queryData}`,
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
      merge: (currentCache, newItems) => {

        if (newItems?.products?.current_page > 1) {
          currentCache.products.data.push(...newItems.products.data);
          currentCache.products.current_page = newItems.products.current_page;
          currentCache.products.last_page = newItems.products.last_page;
        } else {
          currentCache.products.data = newItems.products.data;
          currentCache.products.current_page = newItems.products.current_page;
          currentCache.products.last_page = newItems.products.last_page;
        }
      },
      forceRefetch({ currentArg, previousArg }) {
        return currentArg?.page !== previousArg?.page || currentArg?.category !== previousArg?.category || currentArg?.sortby!==previousArg?.sortby || currentArg?.searchKey !== previousArg?.searchKey;
      },
    }),
  }),
});

export const { useShopPageInfoQuery, useLazyShopPageInfoQuery } = productsApi;
