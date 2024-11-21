"use client";
import { useState } from "react";
import "./style.css";

export default function DropDown({
  datas = [],
  className,
  action,
  position = "left",
  children,
  width,
  height,
}) {
  const [item, setItem] = useState(datas[0]);
  const [toggle, setToggle] = useState(false);
  const handler = (e, value) => {
    if (action) {
      action(value);
    }
    setItem(value);
    setToggle(!toggle);
  };
  return (
    <>
      {datas.length > 0 && (
        <div className={`my-select-box ${className || ""}`}>
          <button
            onClick={() => setToggle(!toggle)}
            type="button"
            className="my-select-box-btn"
          >
            {children ? children({ item }) : <span>{item?.name}</span>}
          </button>
          {toggle && (
            <div
              className="click-away"
              onClick={() => setToggle(!toggle)}
            ></div>
          )}
          <div
            style={{
              height: height ? `${height}px` : "auto",
              width: `${width}px`,
            }}
            className={`my-select-box-section ${
              toggle ? "open" : ""
            } ${position}`}
          >
            <ul className="list">
              {datas.map((value) => (
                <li
                  className={item === value ? "selected" : ""}
                  key={Math.random() + value}
                  onClick={(e) => handler(e, value)}
                >
                  {value.name}
                </li>
              ))}
            </ul>
          </div>
        </div>
      )}
    </>
  );
}
