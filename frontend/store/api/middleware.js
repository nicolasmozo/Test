import { isRejectedWithValue } from "@reduxjs/toolkit";
import { userLoggedOut } from "../features/auth/authSlice";

/**
 * Log a warning and show a toast!
 */
export const rtkQueryErrorLogger = (api) => (next) => (action) => {
  if (isRejectedWithValue(action)) {
    if (action.payload.status === 401) {
      api.dispatch(userLoggedOut());
      localStorage.removeItem("auth");
      window.location.pathname = "/auth/signin";
    }
  }

  return next(action);
};
