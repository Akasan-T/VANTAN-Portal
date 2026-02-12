// 出席API
import API from "./client";

//QRから授業情報を取得
// @param {string} code - QRコードの値

// QRチェック
export const getScheduleByCode = async (code) => {
    try {
        const res = await API.post("/student/attendance/check", { code });
        return res.data;
    } catch (err) {
        handleError("授業情報の取得に失敗しました");
    }
};

// 出席登録

// @param {number} scheduleId - 授業ID
// @param {number} seatId - 座席ID
export const storeAttendance = async (scheduleId, seatId) => {
    try {
        const res = await API.post("/student/attendance/store", {
            schedule_id: scheduleId,
            seat_id: seatId,
        });
        return res.data;
    } catch (err) {
        handleError(err, "出席登録に失敗しました");
    }
}

// 今日の自分の出席状況取得
export const getTodayAttendance = async () => {
    try {
        const res = await API.get("/student/attendance/today");
        return res.data;
    } catch (err) {
        handleError(err, "出席状況の取得に失敗しました");
    }
};

// 共通エラーハンドリング
const handleError = (err, defaultMessage) => {
    if (err.response) {
        throw new Error(err.response.data.message || defaultMessage);
    } else {
        throw new Error("通信エラーが発生しました");
    }
}