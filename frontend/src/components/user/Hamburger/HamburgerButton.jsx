// ハンバーガーメニューボタン
import styles from "./HamburgerButton.module.css";

function HamburgerButton ({ isOpen, onClick }) {
    return (
        <button
            onClick={onClick}
            style={styles.button}
            aria-label="menu"
        >
            {isOpen ? "✕" : "☰"}
        </button>
    );
}

export default HamburgerButton;