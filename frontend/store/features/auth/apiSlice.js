import { toast } from "react-toastify";
import { apiSlice } from "../../api/apiSlice";
import { userLoggedIn, userLoggedOut } from "./authSlice";
// useRouter

export const authApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    login: builder.mutation({
      query: (data) => {
        const bodyFormData = new FormData();
        bodyFormData.append("email", data.email);
        bodyFormData.append("password", data.password);
        return {
          url: "store-login",
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      async onQueryStarted(_, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const { data: result } = await queryFulfilled;
          if (result["access_token"]) {
            localStorage.setItem(
              "auth",
              JSON.stringify({
                accessToken: result["access_token"],
                expiresIn: result["expires_in"],
                user: result.user,
              })
            );
            dispatch(
              userLoggedIn({
                accessToken: result["access_token"],
                expiresIn: result["expires_in"],
                user: result.user,
              })
            );
            toast.update(id, {
              render: `Login Successfully`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          if (error?.data?.message) {
            toast.update(id, {
              render: `${error.data.message}`,
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
      },
    }),
    userRegister: builder.mutation({
      query: (data) => {
        const bodyFormData = new FormData();
        Object.entries({
          firstName: data.firstName,
          lastName: data.lastName,
          name: data.userName,
          email: data.email,
          password: data.password,
          password_confirmation: data.password_confirmation,
          agree: data.agree,
        }).map(([key, value]) => {
          bodyFormData.append(`${key}`, value);
        });
        return {
          url: "store-register",
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const { data } = await queryFulfilled;
          if (data.message.includes("verify")) {
            toast.update(id, {
              render: `Account created successfully.`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          } else if (data.message) {
            toast.update(id, {
              render: `Something went to wrong`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          if (error) {
            if (error.data) {
              toast.update(id, {
                render: error?.data?.message,
                type: "error",
                isLoading: false,
                autoClose: 2000,
              });
            }
          }
        }
      },
    }),
    userVerification: builder.mutation({
      query: ({ email, token }) => {
        const bodyFormData = new FormData();
        Object.entries({ email: email, token: token }).map(([key, value]) => {
          bodyFormData.append(`${key}`, value);
        });
        return {
          url: `user-verification`,
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const { data } = await queryFulfilled;

          if (data.notification === "Verification Successfully") {
            dispatch(
              userLoggedIn({
                accessToken: data["access_token"],
                expiresIn: data["expires_in"],
                user: data.user,
              })
            );
            localStorage.setItem(
              "auth",
              JSON.stringify({
                accessToken: data["access_token"],
                expiresIn: data["expires_in"],
                user: data.user,
              })
            );
            toast.update(id, {
              render: `${data.notification}`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          if (error?.data?.notification) {
            toast.update(id, {
              render: `${error.data.notification}`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          } else if (error?.data?.message) {
            toast.update(id, {
              render: `${error.data.message}`,
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
      },
    }),
    resendOTP: builder.mutation({
      query: (data) => {
        const bodyFormData = new FormData();
        bodyFormData.append("email", data);
        return {
          url: "resend-register",
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const data = await queryFulfilled;
          if (data?.meta.response.status === 200) {
            toast.update(id, {
              render: `${data.data.message}`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          } else {
            toast.update(id, {
              render: `${data.notification}`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch (error) {
          toast.update(id, {
            render: `Error occurred!`,
            type: "error",
            isLoading: false,
            autoClose: 2000,
          });
        }
      },
    }),
    forgetPassword: builder.mutation({
      query: (data) => {
        const bodyFormData = new FormData();
        bodyFormData.append("email", data);
        return {
          url: "send-forget-password",
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const { data } = await queryFulfilled;
          if (data?.message === "Reset password OTP send to your email.") {
            toast.update(id, {
              render: `${data.message}`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          } else if (data?.message) {
            toast.update(id, {
              render: `${data.message}`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          if (error?.data?.notification) {
            toast.update(id, {
              render: `${error.data.notification}`,
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
      },
    }),
    forgetPasswordVerification: builder.mutation({
      query: ({ email, token }) => {
        const bodyFormData = new FormData();
        Object.entries({ email: email, token: token }).map(([key, value]) => {
          bodyFormData.append(`${key}`, value);
        });
        return {
          url: `verify-reset-password-token`,
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const data = await queryFulfilled;
          if (data.meta.response.status === 200) {
            toast.update(id, {
              render: `${data.data.message}`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          if (error?.data?.notification) {
            toast.update(id, {
              render: `${error.data.notification}`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          } else if (error?.data?.message) {
            toast.update(id, {
              render: `${error.data.message}`,
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
      },
    }),
    resetPassword: builder.mutation({
      query: (data) => {
        const bodyFormData = new FormData();
        bodyFormData.append("token", data.code);
        bodyFormData.append("email", data.email);
        bodyFormData.append("password", data.password);
        bodyFormData.append(
          "password_confirmation",
          data.password_confirmation
        );
        return {
          url: `store-reset-password`,
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const data = await queryFulfilled;
          if (data.meta.response.status === 200) {
            toast.update(id, {
              render: `${data.data.message}`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          if (error?.data?.message) {
            toast.update(id, {
              render: `${error.data.message}`,
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
      },
    }),
    updatePassword: builder.mutation({
      query: ({ passwords, resetPassword }) => {
        const bodyFormData = new FormData();
        Object.entries(passwords).map(([key, value]) => {
          bodyFormData.append(`${key}`, value);
        });
        return {
          url: `user/update-password`,
          method: "POST",
          body: bodyFormData,
          formData: true,
        };
      },
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const data = await queryFulfilled;
          if (data.meta.response.status === 200) {
            info.resetForms();
            toast.update(id, {
              render: `${data.data.message}`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          if (error?.data?.message) {
            toast.update(id, {
              render: `${error.data.message}`,
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
      },
    }),
    logout: builder.query({
      query: () => ({
        url: `user-logout`,
      }),
      async onQueryStarted(info, { queryFulfilled, dispatch }) {
        const id = toast.loading("Please Wait...", {
          position: "top-right",
          closeButton: true,
        });
        try {
          const data = await queryFulfilled;
          if (data.meta.response.status === 200) {
            toast.update(id, {
              render: `logout Successfully`,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
            localStorage.removeItem("auth");
            dispatch(userLoggedOut());
          }
        } catch (error) {
          if (error?.data?.message) {
            toast.update(id, {
              render: `${error.data.message}`,
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
      },
    }),
  }),
});

export const {
  useUserRegisterMutation,
  useUserVerificationMutation,
  useResendOTPMutation,
  useForgetPasswordMutation,
  useResetPasswordMutation,
  useLazyLogoutQuery,
  useLoginMutation,
  useForgetPasswordVerificationMutation,
  useUpdatePasswordMutation,
} = authApi;
