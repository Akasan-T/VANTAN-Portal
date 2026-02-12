// リンクをまとめるリスト
import styles from "./MenuList.module.css";
import MenuLink from "./MenuLink";

function MenuList() {
    return (
        <ul className={styles.list}>
            <MenuLink 
                text="ホーム" 
                to="top" 
                
            />
            <MenuLink 
                text="出席確認" 
                to="attendance" 
                
            />
        </ul>
    );
}

export default MenuList;