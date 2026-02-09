// 教室でQRコードを読み取った後に出る座席選択ページ
import PageTitle from "../../../components/user/Page/PageTitle";
import PageSection from "../../../components/user/Page/PageSection";
import PageSectionBox from "../../../components/user/Page/PageSectionBox";

function SeatSelection() {
    return (
        <>
            <PageTitle title="チーム制作(402)"/>

            <PageSection>
                <PageSectionBox title="座席を選択">
                    <p>あいうえお</p>
                </PageSectionBox>
            </PageSection>
        </>
    );
}

export default SeatSelection;