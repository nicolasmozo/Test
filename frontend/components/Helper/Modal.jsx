import { useEffect } from "react";
import { createPortal } from "react-dom";
const Modal = ({ children }) => {
  const mountElement = document.getElementById("portal-root");
  const elementDiv = document.createElement("div");
  useEffect(() => {
    mountElement.appendChild(elementDiv);
    try {
      if (mountElement.childNodes === elementDiv) {
        return () => mountElement.removeChild(elementDiv);
      }
    } catch (error) {}
  }, [elementDiv, mountElement]);
  return createPortal(children, elementDiv);
};
export default Modal;
