import {apiSlice} from "@/store/api/apiSlice";
import {toast} from "react-toastify";

export const contactApi =apiSlice.injectEndpoints({
    endpoints:(builder)=>({
        sendContactMessage:builder.mutation({
            query:(data)=>{
                const bodyFormData = new FormData();
                bodyFormData.append("email", data.email);
                bodyFormData.append("company_name", data.company_name);
                bodyFormData.append("phone", data.phone);
                bodyFormData.append("address", data.address);
                bodyFormData.append("document_type", data.document_type);
                bodyFormData.append("document", data.document);
                bodyFormData.append("logo", data.logo);
                return{
                    url:`/send-contact-message?lang_code=en`,
                    method: "POST",
                    body:bodyFormData
                }
            },
            async onQueryStarted(info,{queryFulfilled,dispatch}){
                const id = toast.loading("Please Wait...", {
                    position: "top-right",
                    closeButton: true,
                });
                try {
                    const { data } = await queryFulfilled;
                    if (data?.message) {
                        toast.update(id, {
                            render: `${data?.message}`,
                            type: "success",
                            isLoading: false,
                            autoClose: 2000,
                        });
                    }
                } catch ({ error }) {
                    if (error?.data?.message) {
                        toast.update(id, {
                            render: `${error?.data?.message}`,
                            type: "error",
                            isLoading: false,
                            autoClose: 2000,
                        });
                    } else {
                        toast.update(id, {
                            render: `Error occurred!`,
                            type: "error",
                            isLoading: false,
                            autoClose: 2000,
                        });
                    }
                }
            }
        })
    })
})

export const { useSendContactMessageMutation } = contactApi;