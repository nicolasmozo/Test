import { configureStore } from "@reduxjs/toolkit";
import authReducer from "./features/auth/authSlice";
import { apiSlice } from "./api/apiSlice";
import setupSlice from "./features/setup/setupSlice";
import paginationReducer from "./features/pagination/paginationSlice";
import { rtkQueryErrorLogger } from "./api/middleware";

export const store = configureStore({
  reducer: {
    [apiSlice.reducerPath]: apiSlice.reducer,
    auth: authReducer,
    defaultSettings: setupSlice,
    pagination: paginationReducer,

  },
  middleware: (getDefaultMiddlewares) =>
    getDefaultMiddlewares().concat(apiSlice.middleware, rtkQueryErrorLogger),
});
