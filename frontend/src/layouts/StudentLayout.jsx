// 生徒側ページ共通レイアウト
import styles from "./StudentLayout.module.css"
import Header from "../components/user/Header/Header";
import { Outlet } from "react-router-dom";

function StudentLayout() {
    return (
        <div className={styles.layout}>
            <div className={styles.container}>
                <Header showMenu={true}/>
                <main className={styles.main}>
                    <Outlet/>
                </main>
            </div>
        </div>
    )
}

export default StudentLayout;