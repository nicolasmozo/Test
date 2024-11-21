"use client";
import React, { useState } from "react";
import {
  useResendOTPMutation,
  useUserVerificationMutation,
} from "@/store/features/auth/apiSlice";
import { useParams, useRouter } from "next/navigation";
import PageTitleArea from "@/components/Common/PageTitleArea";
import VerifyCode from "@/components/Containers/VerifyCode";

function Page() {
  const { verify: verifyMail } = useParams();
  const [userVerification, { isLoading: verifying, data }] =
    useUserVerificationMutation();
  const [resendOTP] = useResendOTPMutation();
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
    if (!isNaN(Number(e.target.value))) {
      setCode((prev) => ({
        ...prev,
        [e.target.getAttribute("data-index")]: e.target.value,
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
    resendOTP(verifyMail.replace("%40", "@"));
  };

  if (data?.access_token) {
    router.push(`/`);
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
