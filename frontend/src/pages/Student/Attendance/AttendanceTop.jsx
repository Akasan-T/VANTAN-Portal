// 出席確認アプリのトップページ
import PageTitle from "../../../components/user/Page/PageTitle";
import PageSection from "../../../components/user/Page/PageSection";
import PageSectionBox from "../../../components/user/Page/PageSectionBox";

function AttendanceTop() {
    return (
        <>
            <PageTitle title="出席確認"/>

            <PageSection>
                <PageSectionBox title="現在出席中">
                    <p>あいうえお</p>
                </PageSectionBox>
                <PageSectionBox title="02/07の出席状況">
                    <p>あいうえお</p>
                </PageSectionBox>
            </PageSection>
        </>
    );
}

export default AttendanceTop;