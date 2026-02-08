// メニューの中に置くリンク
import { Link } from "react-router-dom";
import styles from "./MenuLink.module.css";

function MenuLink({ text, to, onClick }) {
    return (
        <li className={styles.item}>
            <Link to={to} onClick={onClick}>
                {text}
            </Link>
        </li>
    );
}

export default MenuLink;