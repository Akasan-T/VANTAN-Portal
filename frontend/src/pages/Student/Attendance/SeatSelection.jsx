// 教室でQRコードを読み取った後に出る座席選択ページ
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { useLogin } from "../../../context/LoginContext";
import PageTitle from "../../../components/user/Page/PageTitle";
import PageSection from "../../../components/user/Page/PageSection";
import PageSectionBox from "../../../components/user/Page/PageSectionBox";
import { getScheduleByCode, storeAttendance } from "@/api/attendance";

function SeatSelection() {
    const { user } = useLogin();
    const { code } = useParams();

    const [schedule, setSchedule] = useState(null);
    const [seats, setSeats] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const data = await getScheduleByCode(code);
                console.log("取得データ:", data);

                setSchedule(data);
                setSeats(data.seats || []);
            } catch (error) {
                alert("授業情報の取得に失敗しました");
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [code]);

    // seats更新確認用（デバッグ）
    useEffect(() => {
        console.log("seats更新:", seats);
    }, [seats]);

    
    const handleAttendance = async (seatId) => {
        console.log("クリック seatId:", seatId);
        console.log("schedule:", schedule);

        try {
            // schedule.id がない可能性に対応
            const scheduleId = schedule?.id || schedule?.schedule_id;

            if (!scheduleId) {
                alert("授業IDが取得できません");
                return;
            }

            await storeAttendance(scheduleId, seatId);

            // フィールド名ズレ対策（is_taken / taken 両対応）
            setSeats((prev) =>
                prev.map((seat) =>
                    seat.id === seatId
                        ? {
                            ...seat,
                            is_taken: true,
                            taken: true,
                        }
                        : seat
                )
            );
            alert("出席しました！");
        } catch (error) {
            console.error(error);
            alert("出席に失敗しました");
        }
    };

    if (loading) return <p>読み込み中...</p>;
    if (!schedule) return <p>授業が見つかりません</p>;

    return (
        <>
            <PageTitle 
                title={`${schedule.class_name} (${schedule.room_name})`} 
                role={user?.role || "student"}/>
            <div>
                <h1>授業コード: {code}</h1>
            </div>

            <PageSection>
                <PageSectionBox title="座席を選択">
                    <div
                        style={{
                            display: "grid",
                            gridTemplateColumns: "repeat(5, 1fr)",
                            gap: "12px",
                        }}
                    >
                        {seats.map((seat) => {
                            const isTaken =
                                seat.is_taken ?? seat.taken ?? false;

                            return (
                                <div
                                    key={seat.id}
                                    style={{
                                        border: "1px solid #ccc",
                                        padding: "10px",
                                        textAlign: "center",
                                    }}
                                >
                                    <div>
                                        {seat.seat_code ??
                                            seat.number ??
                                            seat.id}
                                    </div>

                                    <button
                                        disabled={isTaken}
                                        onClick={() =>
                                            handleAttendance(seat.id)
                                        }
                                        style={{
                                            marginTop: "5px",
                                            width: "100%",
                                            background: isTaken
                                                ? "#ccc"
                                                : "#4CAF50",
                                            color: "#fff",
                                            border: "none",
                                            padding: "6px",
                                            cursor: isTaken
                                                ? "not-allowed"
                                                : "pointer",
                                        }}
                                    >
                                        {isTaken ? "×" : "出席"}
                                    </button>
                                </div>
                            );
                        })}
                    </div>
                </PageSectionBox>
            </PageSection>
        </>
    );
}

export default SeatSelection;