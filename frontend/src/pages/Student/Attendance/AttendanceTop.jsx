// 出席確認のトップページ
import { useState, useEffect, cache } from "react";
import { useLocation, useNavigate} from "react-router-dom";
import toast from "react-hot-toast";
import dayjs from "dayjs";
import { useLogin } from "../../../context/LoginContext";
import PageTitle from "../../../components/user/Page/PageTitle";
import PageSection from "../../../components/user/Page/PageSection";
import PageSectionBox from "../../../components/user/Page/PageSectionBox";
import ActionButton from "../../../components/Button/ActionButton";
import Modal from "../../../components/Modal/Modal";
import QRScanner from "../../../components/QR/QRScanner";
import { getTodayAttendance } from "@/api/attendance";
import StatusList from "../../../components/user/List/StatusList";

function AttendanceTop() {
    // ログイン中ユーザー情報取得
    const { user } = useLogin();

    // QRモーダル開閉管理
    const [isModalOpen, setIsModalOpen] = useState(false);

    // 当日の出席状況を取得
    const [todayAttendance, setTodayAttendance] = useState([]);
    const [loadingToday, setLoadingToday] = useState(true);

    // 画面遷移用
    const navigate = useNavigate();

    // 全画面から渡されたstate取得
    const location = useLocation();

    // QRコード読み取り成功時の処理
    // 読み取ったコードを使って座席選択ページへ遷移
    const handleScan = (code) => {
        setIsModalOpen(false);
        navigate(`seat/${code}`);
    };

    // 座席選択ページから戻ってきた際のメッセージ表示
    useEffect(() => {
        if (location.state?.message) {
            toast.success(location.state.message);

             // stateを削除してリロード時の再表示を防ぐ
            navigate(location.pathname, { replace: true });
        }
    }, [location.state, navigate]);

    // 今日の出席状況取得
    useEffect(() => {
        const fetchToday = async () => {
            try {
                const data = await getTodayAttendance();
                setTodayAttendance(data);
            } catch (error) {
                toast.error(error.message || "今日の出席状況の取得に失敗しました")
            } finally {
                setLoadingToday(false);
            }
        };
        fetchToday();
    }, []);

    return (
        <>
            <PageTitle title="出席確認" role={user?.role || "student"}/>

            <PageSection>
                <PageSectionBox title="現在出席中">
                    <p>テスト</p>
                </PageSectionBox>
                <PageSectionBox title={`${dayjs().format("MM/DD")}の出席状況`}>
                    {loadingToday ? <p>読み込み中...</p> 
                        : <StatusList attendances={todayAttendance} 
                    />}
                </PageSectionBox>

                <ActionButton
                    onClick={() => setIsModalOpen(true)} 
                    variant="student" 
                    size="lg"
                >
                    QRコードを読み込む
                    <img src="/QR-icon.svg" alt="QRコード" />
                </ActionButton>

                <Modal isOpen={isModalOpen} onClose={() => setIsModalOpen(false)}>
                    <PageTitle title="QRコードを読み取ってください" role={user?.role || "student"}/>
                    <QRScanner onScan={handleScan}/>
                </Modal>
            </PageSection>
        </>
    );
}

export default AttendanceTop;