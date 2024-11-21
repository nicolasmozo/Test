"use client";
import React, { useState } from "react";
import PageTitleArea from "@/components/Common/PageTitleArea";
import VerifyCode from "@/components/Containers/VerifyCode";
import { useParams, useRouter } from "next/navigation";
import {
  useForgetPasswordMutation,
  useForgetPasswordVerificationMutation,
} from "@/store/features/auth/apiSlice";
import useLanguage from "@/hooks/useLanguage";

function Page() {
  const { verify: verifyMail } = useParams();

  const [userVerification, { isLoading: verifying, isSuccess }] =
    useForgetPasswordVerificationMutation();
  const [forgotPassword, { isLoading }] = useForgetPasswordMutation();
  const router = useRouter();
  const [code, setCode] = useState({
    one: "",
    two: "",
    three: "",
    four: "",
    five: "",
    six: "",
  });
  const handleInput = (e) => {
    if (!isNaN(Number(e.key))) {
      setCode((prev) => ({
        ...prev,
        [e.target.getAttribute("data-index")]: e.key,
      }));
      if (e.target.nextElementSibling) {
        e.target.nextElementSibling.focus();
      }
    }
  };
  handleInput.bind(this);

  const handleSubmit = () => {
    const fullCode =
      code.one + code.two + code.three + code.four + code.five + code.six;
    if (fullCode.length >= 6) {
      userVerification({
        email: verifyMail.replace("%40", "@"),
        token: fullCode,
      });
    }
  };
  // handle resend otp
  const handleResendOtp = () => {
    forgotPassword(verifyMail.replace("%40", "@"));
  };

  if (isSuccess) {
    router.push(
      `/auth/new-password/${verifyMail}?code=${
        code.one + code.two + code.three + code.four + code.five + code.six
      }`
    );
  }
  return (
    <>
      <PageTitleArea
        title="Verification"
        breadcrumb={[
          { name: "home", path: "/" },
          { name: "verify", path: "/auth/verify" },
        ]}
      />
      <div className="w-full py-[60px]">
        <div className="theme-container mx-auto">
          <div className="w-full lg:px-[183px]">
            <VerifyCode
              code={code}
              handleInput={handleInput}
              handleSubmit={handleSubmit}
              resendOTP={handleResendOtp}
              verifying={verifying}
            />
          </div>
        </div>
      </div>
    </>
  );
}

export default Page;
