// ベース
import axios from "axios";

const API = axios.create({
    baseURL: "http://localhost:8000/api",
});

// リクエスト時にトークン自動処理
API.interceptors.request.use(config => {
    const token = localStorage.getItem("token");
    if (token) config.headers.Authorization = `Bearer ${token}`;
    return config;
});

export default API;