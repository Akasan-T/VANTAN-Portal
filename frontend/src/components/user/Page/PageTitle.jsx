// 各ページのタイトル
import styles from "./PageTitle.module.css";
function PageTitle({ title, role }) {
    return (
        <>
            <h2 className={`${styles.title} ${styles[role]}`}>{title}</h2>
        </>
    )
}

export default PageTitle;