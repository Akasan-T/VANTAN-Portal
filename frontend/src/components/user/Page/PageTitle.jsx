// 各ページのタイトル
import styles from "./PageTitle.module.css";
function PageTitle({title}) {
    return (
        <>
            <h2 className={styles.title}>{title}</h2>
        </>
    )
}

export default PageTitle;