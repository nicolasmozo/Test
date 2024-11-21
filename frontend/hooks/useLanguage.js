import {useSelector} from "react-redux";

const useLanguage = () => {
    return useSelector((state) => state.defaultSettings?.settings?.localizations);
};

export default useLanguage;