import { setupListeners } from "@reduxjs/toolkit/query";
import { store } from "./store";

setupListeners(store.dispatch, {
  tagTypes: ["cartData"],
});
