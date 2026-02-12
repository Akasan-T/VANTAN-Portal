// ハンバーガーメニューボタン
import styles from "./HamburgerButton.module.css";

function HamburgerButton ({ isOpen, onClick }) {
    return (
        <button
            className={`${styles.button} ${isOpen ? styles.open : ""}`}
            onClick={onClick}
            aria-label="menu"
        >
            <span/>
            <span/>
            <span/>
        </button>
    );
}

export default HamburgerButton;