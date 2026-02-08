// 管理者ページ共通レイアウト
import styles from "./AdminLayout.module.css"
import { Outlet } from "react-router-dom";

function AdminLayout() {
    return (
        <div className={styles.layout}>
            <Header />
            <main className={styles.main}>
                <Outlet />
            </main>
        </div>
    );
}

export default AdminLayout;