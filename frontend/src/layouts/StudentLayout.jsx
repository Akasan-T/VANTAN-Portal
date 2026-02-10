// 生徒側ページ共通レイアウト
import styles from "./StudentLayout.module.css"
import Header from "../components/Header/Header";
import { Outlet } from "react-router-dom";

function StudentLayout() {
    return (
        <div className={styles.layout}>
            <Header role="student" showMenu={true}/>
            <main className={styles.main}>
                <Outlet/>
            </main>
        </div>
    )
}

export default StudentLayout;