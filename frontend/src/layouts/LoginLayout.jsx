// ログイン画面用レイアウト
import styles from "./LoginLayout.module.css";
import Header from "../components/user/Header/Header";
import { Outlet } from "react-router-dom";

function LoginLayout() {
    return (
        <div className={styles.layout}>
        <Header showMenu={false}/>

        <main className={styles.main}>
            <Outlet />
        </main>
        </div>
    );
}

export default LoginLayout;
