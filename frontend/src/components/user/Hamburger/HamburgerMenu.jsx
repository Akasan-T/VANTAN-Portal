// 開いた時のメニューリスト
import styles from "./HamburgerMenu.module.css";

function HamburgerMenu({ isOpen }) {
    if (!isOpen) return null;

    return (
        <div className={styles.overlay}>
            <nav 
                className={styles.menu}
            >
                <ul className={styles.list}>
                    <li>ホーム</li>
                </ul>
            </nav>
        </div>
    );
}

export default HamburgerMenu;