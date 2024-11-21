import {apiSlice} from "@/store/api/apiSlice";
import {toast} from "react-toastify";
export const becomeSellerApi = apiSlice.injectEndpoints({
    endpoints:(builder)=>({
        becomeSeller:builder.mutation({
            query:(data)=>{
                const bodyFormData = new FormData();
                bodyFormData.append("email", data.email);
                bodyFormData.append("phone", data.phone);
                bodyFormData.append("company_name", data.company_name);
                bodyFormData.append("address", data.address);
                bodyFormData.append("document_type", data.document_type);
                bodyFormData.append("document", data.document);
                bodyFormData.append("logo", data.logo);
                bodyFormData.append("callback_url", data.callback_url);
                return {
                    url:`/user/join-as-seller?lang_code=en`,
                    method:'POST',
                    body:bodyFormData,
                    formData:true
                }
            },
            async onQueryStarted(info,{queryFulfilled}){
                const id = toast.loading("Please Wait...", {
                    position: "top-right",
                    closeButton: true,
                });
                try{
                    const {data} = await queryFulfilled;
                    if (data?.message) {
                        info.resetForm();
                        info.redirect();
                        toast.update(id, {
                            render: `${data?.message}`,
                            type: "success",
                            isLoading: false,
                            autoClose: 2000,
                        });
                    }
                }catch (err){
                    if (err?.data?.message) {
                        toast.update(id, {
                            render: `${err?.data?.message}`,
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
        }),
    })
})

export const {useBecomeSellerMutation}=becomeSellerApi;