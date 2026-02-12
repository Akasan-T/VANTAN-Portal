// メニューの中に置くリンク
import { Link } from "react-router-dom";
import styles from "./MenuLink.module.css";

function MenuLink({ text, to, onClick }) {
    return (
        <Link to={to} onClick={onClick}>
            <li className={styles.item}>
                    {text}
            </li>
        </Link>
    );
}

export default MenuLink;