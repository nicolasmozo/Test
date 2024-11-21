import {apiSlice} from "../../api/apiSlice";
export const reviewListApi = apiSlice.injectEndpoints({
    endpoints:(builder)=>({
        reviewList:builder.query({
            query:({
                       id,
                       page
                   })=>{
                return {
                    url:`/product-review-list/${id}?lang_code=en&page=${page}`
                }
            },
            serializeQueryArgs: ({ endpointName }) => {
                return endpointName;
            },
            merge: (currentCache, newItems) => {
                if (newItems?.reviews?.current_page > 1) {
                    currentCache.reviews.data.push(...newItems.reviews.data);
                    currentCache.reviews.current_page = newItems.reviews.current_page;
                    currentCache.reviews.last_page = newItems.reviews.last_page;
                } else {
                    currentCache.reviews.data = newItems.reviews.data;
                    currentCache.reviews.current_page = newItems.reviews.current_page;
                    currentCache.reviews.last_page = newItems.reviews.last_page;
                }
            },
            forceRefetch({ currentArg, previousArg }) {
                return currentArg?.page !== previousArg?.page;
            },
        })
    })
})

export const {useReviewListQuery}=reviewListApi;