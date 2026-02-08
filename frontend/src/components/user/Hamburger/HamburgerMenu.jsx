// 開いた時のメニューリスト
import styles from "./HamburgerMenu.module.css";
import MenuList from "./MenuList";

function HamburgerMenu({ isOpen }) {
    if (!isOpen) return null;

    return (
        <div className={styles.overlay}>
            <nav 
                className={styles.menu}
            >
                <MenuList/>
            </nav>
        </div>
    );
}

export default HamburgerMenu;