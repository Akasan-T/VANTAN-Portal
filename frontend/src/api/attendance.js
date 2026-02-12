// 出席API
import API from "./client";

// 出席チェック
export const checkAttendance = async (code) => {
    try {
        const res = await API.post("/attendance/check", { code });
        return res.data;
    } catch (err) {
        if (err.response) {
            throw new Error(err.response.data.message || "出席チェック失敗");
        } else {
            throw new Error("通信エラー");
        }
    }
};