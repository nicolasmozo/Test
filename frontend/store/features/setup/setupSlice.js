import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    settings:undefined,
    activeCurrency:undefined
};

const setupSlice = createSlice({
    name: "settings",
    initialState,
    reducers: {
        siteSettings:  (state, action) => {
            state.settings = action.payload
            state.activeCurrency = action.payload ? action.payload.currencies && action.payload.currencies.length>0 && action.payload.currencies.filter((item)=>item.is_default==='Yes')[0] :undefined
        },
        changeCurrency: (state,action)=>{
            state.activeCurrency=action.payload
        }
    },
});

export default setupSlice.reducer;
export const { siteSettings,changeCurrency } = setupSlice.actions;
