import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  sellerProductPage: 1,
  ordersPage: 1,
  user: undefined,
};

const paginationSlice = createSlice({
  name: "auth",
  initialState,
  reducers: {
    sellerProductPageIncrease: (state) => {
      state.sellerProductPage = state.sellerProductPage + 1;
    },
    ordersPageIncrease: (state) => {
      state.ordersPage = state.ordersPage + 1;
    },
  },
});

export default paginationSlice.reducer;
export const { sellerProductPageIncrease, ordersPageIncrease } =
  paginationSlice.actions;
