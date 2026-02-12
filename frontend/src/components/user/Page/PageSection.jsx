// Boxを囲むための共通セクション
import styles from "./PageSection.module.css";

function PageSection({ children }) {
    return (
        <section className={styles.section}>
            {children}
        </section>
    )
}

export default PageSection;