import { doFetch } from "./doFetch";

export const useLanguage = async (desired_lang: string, desired_section: string) => 
    await doFetch(`/utils/translations/${desired_lang}/${desired_section}`);
