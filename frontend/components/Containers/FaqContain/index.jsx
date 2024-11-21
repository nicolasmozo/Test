"use client";
import TestimonialSlider from "@/components/Sections/About/TestimonialSlider";
import React, { useState } from "react";

function FaqContain({ faqs, testimonials }) {
  const [selectedFaq, setSelectedFaq] = useState(
    faqs.length > 0 ? faqs[0].id : null
  );
  return (
    <>
      <div className="w-full py-[60px]">
        {selectedFaq && faqs.length > 0 && (
          <div className="theme-container  mx-auto mb-[60px]">
            <div className="w-full flex justify-center mb-[30px] ">
              <div className="w-full flex justify-center">
                <div>
                  <p className="text-xl text-primary-blue mb-2.5 text-center">
                    FAQs
                  </p>
                  <h2 className="text-[24px] lg:w-[500px] w-full font-bold leading-[34px] text-white mb-3.5 text-center">
                    Frequently Asked Questions About Our Healthcare Application
                  </h2>
                </div>
              </div>
            </div>
            <div className="w-full flex justify-center">
              <div className="xl:px-[100px]  grid grid-cols-1 gap-[15px]">
                {faqs.map((faq, i) => (
                  <div
                    key={i}
                    className={`w-full rounded-md border overflow-hidden  ${
                      selectedFaq === Number(faq.id)
                        ? "border-primary-blue"
                        : "border-transparent"
                    }`}
                  >
                    <button
                      onClick={() => setSelectedFaq(Number(faq.id))}
                      type="button"
                      className="w-full lg:px-[30px] lg:py-[28px]  p-3.5 bg-black rounded-md flex justify-between rtl:space-x-reverse space-x-5 items-center mb-1"
                    >
                      <p className="text-xl font-semibold text-start text-white leading-6 line-clamp-1">
                        {faq.question}
                      </p>
                      <span className="text-primary-blue">
                        <svg
                          width="13"
                          height="8"
                          viewBox="0 0 13 8"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M6.14844 7.55469L0.367187 1.85156C0.171875 1.65625 0.171875 1.34375 0.367187 1.1875L1.14844 0.406249C1.34375 0.210937 1.61719 0.210937 1.8125 0.406249L6.5 5.01562L11.1484 0.40625C11.3437 0.210937 11.6562 0.210937 11.8125 0.40625L12.5937 1.1875C12.7891 1.34375 12.7891 1.65625 12.5937 1.85156L6.8125 7.55469C6.61719 7.75 6.34375 7.75 6.14844 7.55469Z"
                            fill="currentColor"
                          />
                        </svg>
                      </span>
                    </button>
                    {selectedFaq === Number(faq.id) && (
                      <div className="w-full bg-black lg:px-[30px] lg:py-[28px] p-3.5">
                        <div
                          dangerouslySetInnerHTML={{ __html: faq.answer }}
                          className="text-lg font-thin text-white leading-[32px]"
                        ></div>
                      </div>
                    )}
                  </div>
                ))}
              </div>
            </div>
          </div>
        )}

        <div className="theme-container mx-auto">
          <TestimonialSlider datas={testimonials} />
        </div>
      </div>
    </>
  );
}

export default FaqContain;
