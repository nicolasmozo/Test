import React, { useEffect, useState } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/pagination";
import { Autoplay, Pagination, EffectFade } from "swiper/modules";
import "swiper/css/effect-fade";

export default function SwiperSliderCom({ options, children, dotsLabel }) {
  const swiperOptions = {
    ...options,
    pagination: {
      el: `.${dotsLabel}`,
      clickable: true,
    },
  };
  const [direction, setDirection] = useState("ltr");
  useEffect(() => {
    const direction = document.body.getAttribute("dir");
    setDirection(direction);
  }, []);
  return (
    <>
      <Swiper
        dir={direction}
        {...swiperOptions}
        modules={[Autoplay, Pagination, EffectFade]}
        className="swiper"
      >
        {React.Children.map(children, (child) => (
          <SwiperSlide>{child}</SwiperSlide>
        ))}
      </Swiper>
      {dotsLabel && (
        <div className={`${dotsLabel} relative z-10 pointer-events-auto`}></div>
      )}
    </>
  );
}
