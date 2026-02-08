// 開いた時のメニューリスト
import styles from "./HamburgerMenu.module.css";

function HamburgerMenu({ isOpen, onClose }) {
    if (!isOpen) return null;

    return (
        <div
            style={styles.overlay}
            onClick={onClose}
        >
            <div
                
            >

            </div>

        </div>
    )
}