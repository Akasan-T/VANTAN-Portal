// ログイン画面用レイアウト
import styles from "./LoginLayout.module.css";
import Header from "../components/Header/Header";
import { Outlet } from "react-router-dom";

function LoginLayout({role}) {
    return (
        <div className={styles.layout}>
        <Header role={role} showMenu={false}/>

        <main className={styles.main}>
            <Outlet />
        </main>
        </div>
    );
}

export default LoginLayout;
