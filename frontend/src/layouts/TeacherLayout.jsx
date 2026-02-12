// 教師側ページ共通レイアウト
import styles from "./TeacherLayout.module.css"
import { Outlet } from "react-router-dom";

function TeacherLayout() {
    return (
        <div className={styles.layout}>
            <Header role="teacher" showMenu={false}/>
            <main className={styles.main}>
                <Outlet />
            </main>
        </div>
    );
}

export default TeacherLayout;