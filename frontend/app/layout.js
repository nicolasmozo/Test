import "./globals.css";
import NextTopLoader from "nextjs-toploader";
import TopBarSmallAnnounce from "@/components/Partials/TopBarSmallAnnounce";
import AppHeader from "@/components/Partials/AppHeader";
import AppFooter from "@/components/Partials/AppFooter";
import "aos/dist/aos.css";
import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import StoreProvider from "@/components/Helper/StoreProvider";
import SiteSetup from "@/components/Partials/SiteSetup";
import { Suspense } from "react";
import Maintainance from "@/components/Helper/Maintainance";
import FacebookPixel from "@/components/Helper/FacebookPixel";
import Script from "next/script";
async function getData() {
  try {
    const res = await fetch(`${process.env.BASE_URL}api/website-setup`, {
      cache: "no-store",
    });

    if (res.ok) {
      return res.json();
    } else {
      throw new Error(
        `Fetch Failed! Check your API BASE_URL ${process.env.BASE_URL + "api"} `
      );
    }
  } catch (error) {
    throw new Error(
      `Fetch Failed! Check your API BASE_URL ${process.env.BASE_URL + "api"} `
    );
  }
}
export default async function RootLayout({ children }) {
  const data = await getData();
  const {
    setting,
    categories,
    languages,
    currencies,
    social_links,
    localizations,
    googleAnalytic,
    tawkChat,
    cookieConsent,
    maintainance,
    homepage_ads,
    shoppage_ads,
    shop_detail_ads,
    footer,
  } = data
    ? data
    : {
        setting: null,
        categories: null,
        languages: null,
        currencies: null,
        social_links: null,
        localizations: null,
        googleAnalytic: null,
        tawkChat: null,
        cookieConsent: null,
        maintainance: null,
        homepage_ads: null,
        shoppage_ads: null,
        shop_detail_ads: null,
        footer: null,
      };
  return (
    <html lang="en">
      <head>
        {/* Google Translate */}
        <Script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></Script>
        <link
          rel="icon"
          type="image/png"
          href={process.env.BASE_URL + setting?.favicon}
        />
        {process.env.PWA === 1 ||
          (process.env.PWA === "1" && (
            <link rel="manifest" href="/manifest.json" />
          ))}
      </head>
      <body dir="ltr" id="portal-root" suppressHydrationWarning={true}>
        <StoreProvider>
          <Maintainance maintainance={maintainance}>
            <SiteSetup
              data={{
                setting,
                categories,
                languages,
                currencies,
                social_links,
                localizations,
                googleAnalytic,
                tawkChat,
                cookieConsent,
                homepage_ads,
                shoppage_ads,
                shop_detail_ads,
                footer,
              }}
            />
            <header>
              <TopBarSmallAnnounce
                currencies={currencies}
                settings={setting}
                languages={languages}
              />
              <AppHeader
                languages={languages}
                currencies={currencies}
                settings={setting}
                categories={categories}
              />
            </header>
            <main>
              {children}
              <Suspense fallback={null}>
                <FacebookPixel />
              </Suspense>
            </main>
            <footer>{<AppFooter />}</footer>
            <ToastContainer />
          </Maintainance>
        </StoreProvider>
        <NextTopLoader color="#FBB322" showSpinner={false} />
      </body>
    </html>
  );
}
