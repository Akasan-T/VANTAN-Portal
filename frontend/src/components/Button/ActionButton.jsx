// ログイン・早退・出席・QR読み込みなどを実行するボタン
import styles from "./ActionButton.module.css";

function ActionButton({
    children,
    onClick,
    type = "button",
    disabled = false,
    variant = "primary",
    size = "md",
}) {
    return (
        <button
            type={type}
            onClick={onClick}
            disabled={disabled}
            className={`${styles.button} ${styles[variant]} ${styles[size]}`}
        >
            {children}
        </button>
    );
}

export default ActionButton;