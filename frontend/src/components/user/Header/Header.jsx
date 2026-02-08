// タイトルのみとハンバーガーメニュー付きを作成
import styles from "./Header.module.css";
import HamburgerButton from "../Hamburger/HamburgerButton";

function Header({
    showMenu = false,
    onMenuClick,
}) {
    return (
        <header style={Styles.header}>
            <h1 style={styles.title}>VANTAN<br/>POTAL</h1>

            {showMenu && (
                <HamburgerButton onClick={onMenuClick}/>
            )}
        </header>
    )
}

export default Header;