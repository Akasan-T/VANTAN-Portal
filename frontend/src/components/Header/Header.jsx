// タイトルのみとハンバーガーメニュー付きを作成
import styles from "./Header.module.css";
import { useState, useEffect } from "react";
import { useLocation } from "react-router-dom";
import HamburgerButton from "../user/Hamburger/HamburgerButton";
import HamburgerMenu from "../user/Hamburger/HamburgerMenu";

function Header({ showMenu = false, role }) {
    const [isOpen, setIsOpen] = useState(false);
    const location = useLocation();

    // ページ移動時メニューを閉じる
    useEffect(() => {
        setIsOpen(false);
    }, [location.pathname]);

    return (
        <>
            <header 
                className={`${styles.header} ${role ? styles[role] : ""}`}>
                <h1 className={styles.title}>
                    VANTAN<br/>POTAL
                </h1>

                {showMenu && (
                    <div className={styles.menu}>
                        <HamburgerButton
                            isOpen={isOpen}
                            onClick={() => setIsOpen(!isOpen)}
                        />
                    </div>
                )}
            </header>
            {showMenu && <HamburgerMenu 
                            isOpen={isOpen}
                            onClose={() => setIsOpen(false)}
                        />
            }
        </>
    );
}

export default Header;