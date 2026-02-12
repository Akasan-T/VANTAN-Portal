// 座席選択ページ
import { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import toast from "react-hot-toast";
import { useLogin } from "../../../context/LoginContext";
import PageTitle from "../../../components/user/Page/PageTitle";
import PageSection from "../../../components/user/Page/PageSection";
import PageSectionBox from "../../../components/user/Page/PageSectionBox";
import SeatList from "../../../components/user/Seat/SeatList";
import { getScheduleByCode, storeAttendance } from "@/api/attendance";

function SeatSelection() {
    const { user } = useLogin();
    const { code } = useParams();
    const navigate = useNavigate();

    // 授業情報
    const [schedule, setSchedule] = useState(null);
    
    // 座席一覧
    const [seats, setSeats] = useState([]);

    // 初期ロード状態管理
    const [loading, setLoading] = useState(true);

    // 出席ボタン連打防止
    const [submitting, setSubmitting] = useState(false);

    // QRコードから授業情報取得
    useEffect(() => {
        const fetchData = async () => {
            try {
                const data = await getScheduleByCode(code);
                
                // 出席済み自動的にリダイレクト
                if (data.already_attended) {
                    navigate("/student/attendance", {
                        state: { message: "既に出席済みです" }
                    });
                    return;
                }

                // 授業情報と座席情報をセット
                setSchedule(data);
                setSeats(data.seats || []);

            } catch (error) {
                if (error.response) {
                    // 期限切れ判定
                    if (error.response?.data?.expired) {
                        toast.error("QRコードの有効期限が切れました");

                        navigate("/student/attendance", {
                            state: { message: "再度QRコードを読み込んでください"}
                        });

                        return;
                    }
                    // 他のエラー
                    toast.error(error.response.data?.message || "授業情報が取得できませんでした");
                } else {
                    // ネットワークエラーなど
                    toast.error("授業情報の取得に失敗しました");
                }
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [code, navigate]);
    
    // 座席選択時の出席登録処理
    const handleAttendance = async (seatId) => {

        // 二重送信防止
        if (submitting) return;
        setSubmitting(true);

        try {
            const scheduleId = schedule?.schedule_id;

            // 出席登録API呼び出し
            const data = await storeAttendance(scheduleId, seatId);

            // サーバー側で出席済み
            if (data?.already_attended) {
                toast.error("既に出席済みです");
                navigate("/student/attendance");
                return;
            }

            toast.success("出席しました！");
            navigate("/student/attendance");

        } catch (error) {
            toast.error(error.message || "出席に失敗しました");
        }
    };

    if (loading) return <p>読み込み中...</p>;
    if (!schedule) return <p>授業が見つかりません</p>;

    return (
        <>
            <PageTitle 
                title={`${schedule.class_name} (${schedule.room_name})`} 
                role={user?.role || "student"}/>

            <PageSection>
                <PageSectionBox title="座席を選択">
                    <SeatList
                        seats={seats}
                        submitting={submitting}
                        onSelect={handleAttendance}
                    />
                </PageSectionBox>
            </PageSection>
        </>
    );
}

export default SeatSelection;