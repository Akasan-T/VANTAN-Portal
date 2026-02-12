// 出席確認アプリのトップページ
import { useState } from "react";

import { useLogin } from "../../../context/LoginContext";
import PageTitle from "../../../components/user/Page/PageTitle";
import PageSection from "../../../components/user/Page/PageSection";
import PageSectionBox from "../../../components/user/Page/PageSectionBox";
import ActionButton from "../../../components/Button/ActionButton";
import Modal from "../../../components/Modal/Modal";
import QRScanner from "../../../components/QR/QRScanner";

function AttendanceTop() {
    const { user } = useLogin();
    const [isModalOpen, setIsModalOpen] = useState(false);

    const handleScan = (code) => {
        setIsModalOpen(false);
        navigate(`/SeatSelection/${code}`);
    };

    return (
        <>
            <PageTitle title="出席確認" role={user?.role || "student"}/>

            <PageSection>
                <PageSectionBox title="現在出席中">
                    <p>あいうえお</p>
                </PageSectionBox>
                <PageSectionBox title="02/07の出席状況">
                    <p>あいうえお</p>
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
                    <QRScanner onScan={(text) => {
                        alert("読み取ったQR： " + text);
                    }}/>
                </Modal>
            </PageSection>
        </>
    );
}

export default AttendanceTop;