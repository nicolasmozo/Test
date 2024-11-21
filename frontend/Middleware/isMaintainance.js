"use client";
import { useRouter } from "next/navigation";
/* eslint-disable react/display-name */
const isMaintainance = (WrappedComponent) => {
  return (props) => {
    const { maintainance } = props;
    const Router = useRouter();
    if (maintainance && Number(maintainance.status) === 0) {
      return <WrappedComponent {...props} />;
    } else if (maintainance && Number(maintainance.status) === 1) {
      return (
        <div className="w-full h-screen flex justify-center items-center">
          {maintainance && (
            <div className=" text-center">
              <div className="mb-5 flex justify-center">
                {maintainance && (
                  <img
                    src={`${process.env.BASE_URL + maintainance.image}`}
                    alt="logo"
                  />
                )}
              </div>
              <div className="w-full flex justify-center">
                <p className="text-center text-3xl text-tblack font-bold">
                  {maintainance.description}
                </p>
              </div>
            </div>
          )}
        </div>
      );
    } else {
      return false;
    }
  };
};

export default isMaintainance;
