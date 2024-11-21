import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  accessToken: undefined,
  tokenExpire: undefined,
  user: undefined,
};

const authSlice = createSlice({
  name: "auth",
  initialState,
  reducers: {
    userLoggedIn: (state, action) => {
      state.accessToken = action.payload.accessToken;
      state.tokenExpire = action.payload.expiresIn;
      state.user = action.payload.user;
    },
    userLoggedOut: (state) => {
      state.accessToken = "";
      state.tokenExpire = "";
      state.user = undefined;
    },
  },
});

export default authSlice.reducer;
export const { userLoggedIn, userLoggedOut } = authSlice.actions;
