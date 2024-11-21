"use client";
import React, { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import {
  siteSettings,
  useActiveCurrency,
} from "@/store/features/setup/setupSlice";
import { userLoggedIn } from "@/store/features/auth/authSlice";
// time ago
import TimeAgo from "javascript-time-ago";
import en from "javascript-time-ago/locale/en.json";
import ru from "javascript-time-ago/locale/ru.json";
TimeAgo.addDefaultLocale(en);
TimeAgo.addLocale(ru);
import Script from "next/script";
import TawkTo from "next-tawkto";
import Consent from "../Helper/Consent";
function SiteSetup({ data }) {
  const dispatch = useDispatch();
  dispatch(siteSettings(data));
  //   when load website add auth in redux store
  useEffect(() => {
    const user = JSON.parse(localStorage.getItem("auth"));
    if (user?.accessToken) {
      dispatch(
        userLoggedIn({
          accessToken: user?.accessToken,
          expiresIn: user?.expiresIn,
          user: user?.user,
        })
      );
    }
  });
  const hexToRgb = (hex, type = "str") => {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    const shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function (r, g, b) {
      return r + r + g + g + b + b;
    });

    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    if (type === "str") {
      return result
        ? `${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(
            result[3],
            16
          )}`
        : null;
    }
    return result
      ? {
          r: parseInt(result[1], 16),
          g: parseInt(result[2], 16),
          b: parseInt(result[3], 16),
        }
      : null;
  };
  const [siteSet, setSiteSet] = useState(null);
  useEffect(() => {
    const primaryBackground = data?.setting?.primary_background;
    const primaryForeground = data?.setting?.primary_foreground;
    if (primaryBackground && primaryForeground) {
      const root = document.querySelector(":root");
      root.style.setProperty(
        "--primary-background",
        `${hexToRgb(primaryBackground)}`
      );
      root.style.setProperty(
        "--primary-foreground",
        `${hexToRgb(primaryForeground)}`
      );
      setTimeout(() => {
        setSiteSet(true);
      }, 310);
    }
    if (!window) return;
    if (data?.tawkChat && Number(data?.tawkChat.status) === 1) {
      new TawkTo(data?.tawkChat?.widget_id, data?.tawkChat?.property_id);
    }
  }, []);
  return (
    <>
      {data?.googleAnalytic && (
        <>
          <Script
            src={`https://www.googletagmanager.com/gtag/js?id=${data.googleAnalytic?.analytic_id}`}
            strategy="afterInteractive"
          />
          <Script id="google-analytics" strategy="afterInteractive">
            {`
          window.dataLayer = window.dataLayer || [];
          function gtag(){window.dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', '${data.googleAnalytic?.analytic_id}');
        `}
          </Script>
        </>
      )}
      {data?.cookieConsent && <Consent data={data.cookieConsent} />}
      {!siteSet && (
        <div className="w-full h-screen fixed top-0 left-0 bg-black z-[999999999999] flex justify-center items-center">
          <div className="progressFirstLoad"></div>
        </div>
      )}
    </>
  );
}

export default SiteSetup;
