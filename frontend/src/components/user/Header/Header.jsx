// タイトルのみとハンバーガーメニュー付きを作成
import styles from "./Header.module.css";
import { useState } from "react";
import HamburgerButton from "../Hamburger/HamburgerButton";
import HamburgerMenu from "../Hamburger/HamburgerMenu";

function Header({
    showMenu = false,
}) {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <>
            <header className={styles.header}>
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