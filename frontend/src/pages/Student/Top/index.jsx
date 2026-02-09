// バンタンポータル総合サイト
// 出勤中のスタッフのリストと公欠申請状態のリストを表示
import PageTitle from "../../../components/user/Page/PageTitle";
import PageSection from "../../../components/user/Page/PageSection";
import PageSectionBox from "../../../components/user/Page/PageSectionBox";

function Top() {
    return (
        <>
            <PageTitle title="ようこそ！〇〇 〇〇〇さん"/>

            <PageSection>
                <PageSectionBox title="現在勤務中のスタッフ">
                    <p>あいうえお</p>
                </PageSectionBox>
                <PageSectionBox title="公欠申請状況">
                    <p>あいうえお</p>
                </PageSectionBox>
            </PageSection>
        </>
    );
}

export default Top;