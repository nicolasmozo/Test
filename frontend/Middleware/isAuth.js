"use client";
import { userLoggedIn } from "@/store/features/auth/authSlice";
import { useRouter } from "next/navigation";
import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
const isAuth = (WrappedComponent) => {
  // eslint-disable-next-line react/display-name
  return (props) => {
    const [checkAuth, setAuth] = useState(false);
    const dispatch = useDispatch();
    const router = useRouter();
    useEffect(() => {
      const user = JSON.parse(localStorage.getItem("auth"));
      if (!user?.accessToken) {
        router.push("/auth/signin");
      } else {
        setAuth(true);
        dispatch(
          userLoggedIn({
            accessToken: user?.accessToken,
            expiresIn: user?.expiresIn,
            user: user?.user,
          })
        );
      }
    }, []);
    if (checkAuth) {
      return <WrappedComponent {...props} />;
    } else {
      return null;
    }
  };
};
export default isAuth;
