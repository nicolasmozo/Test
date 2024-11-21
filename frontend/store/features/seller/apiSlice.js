import {apiSlice} from "../../api/apiSlice";
export const sellerProductApi = apiSlice.injectEndpoints({
    endpoints:(builder)=>({
        sellerProducts:builder.query({
            query:({
                userName,
                page
            })=>{
                return {
                    url:`/author/${userName}?lang_code=en&page=${page}`
                }
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
                return currentArg?.page !== previousArg?.page;
            },
        })
    })
})

export const {useSellerProductsQuery}=sellerProductApi;