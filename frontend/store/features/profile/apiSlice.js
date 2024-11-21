import { toast } from "react-toastify";
import { apiSlice } from "../../api/apiSlice";
// useRouter

export const profileApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    profile: builder.query({
      query: () => {
        return {
          url: "user/edit-profile",
        };
      },
      serializeQueryArgs: ({ endpointName }) => {
        return endpointName;
      },
    }),
    updateProfile: builder.mutation({
      query: ({ profileInfo }) => {
        const bodyFormData = new FormData();
        Object.entries({
          image: profileInfo.image,
          name: profileInfo.name,
          phone: profileInfo.phone,
          address: profileInfo.address,
          about_me: profileInfo.about_me,
        }).map(([key, value]) => {
          if (key === "image") {
            if (typeof profileInfo.image !== "string") {
              bodyFormData.append(`${key}`, value);
            }
          } else {
            bodyFormData.append(`${key}`, value);
          }
        });
        return {
          url: `user/update-profile`,
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
          const { data, meta } = await queryFulfilled;
          if (meta.response.status === 200) {
            toast.update(id, {
              render: data?.message,
              type: "success",
              isLoading: false,
              autoClose: 2000,
            });
            dispatch(
              apiSlice.util.updateQueryData("profile", undefined, (draft) => {
                const oldData = JSON.parse(JSON.stringify(draft));
                oldData.user.name = info.profileInfo.name;
                oldData.user.about_me = info.profileInfo.about_me;
                oldData.user.address = info.profileInfo.address;
                oldData.user.phone = info.profileInfo.phone;
                oldData.user.previewImage = info.profileInfo.previewImage;
                return (draft = oldData);
              })
            );
          } else if (data.message) {
            toast.update(id, {
              render: `Something went to wrong`,
              type: "error",
              isLoading: false,
              autoClose: 2000,
            });
          }
        } catch ({ error }) {
          toast.update(id, {
            render: "Some error hear",
            type: "error",
            isLoading: false,
            autoClose: 2000,
          });
        }
      },
    }),
  }),
});

export const { useProfileQuery, useUpdateProfileMutation } = profileApi;
