// src/context/LoginContext.jsx
import { createContext, useContext, useState, useEffect } from "react";
import { getUser } from "../api/auth";

// 1. Context作成
const LoginContext = createContext(null);

// 2. Providerを作る
export const LoginProvider = ({ children }) => {
    const [user, setUser] = useState(null); // nullなら未ログイン

    useEffect(() => {
        const savedUser = getUser();
        if (savedUser) {
            setUser(savedUser);
        }
    })
    
    const loginUser = (userData) => setUser(userData);  // ログイン時に user をセット
    const logoutUser = () => setUser(null);            // ログアウト時に user をクリア

    return (
        <LoginContext.Provider value={{ user, loginUser, logoutUser }}>
            {children}
        </LoginContext.Provider>
    );
};

// 3. Contextを簡単に使えるカスタムフック
export const useLogin = () => useContext(LoginContext);
