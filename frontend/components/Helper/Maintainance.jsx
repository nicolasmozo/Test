"use client";
import React from "react";
import isMaintainance from "./../../Middleware/isMaintainance";
import AosInit from "./AosInit";

function Maintainance({ maintainance, children }) {
  const childrenWithProps = React.Children.map(children, (child) => {
    return React.cloneElement(child, { maintainance });
  });

  return (
    <div>
      <AosInit />
      {childrenWithProps}
    </div>
  );
}

export default isMaintainance(Maintainance);
