// セクションを囲うボックスの共通テンプレ
import styles from "./PageSectionBox.module.css";

function PageSectionBox({ title, children }) {
    return (
        <div className={styles.box}>
            <div className={styles.title}>
                <h3 className={styles.text}>{title}</h3>
            </div>
            <div className={styles.children}>
                {children}
            </div>
        </div>
    );
}

export default PageSectionBox;