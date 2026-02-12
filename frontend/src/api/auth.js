// ログインAPI
import API from "./client";

export const login = async (email, password) => {
    const res = await API.post("/login", { email, password });
    localStorage.setItem("token", res.data.token);
    localStorage.setItem("user", JSON.stringify(res.data.user));
    return res.data.user;
};

export const fetchMe = async () => {
    const res = await API.get("/me");
    return res.data;
};

export const logout = () => localStorage.clear();
