// src/context/LoginContext.jsx
import { createContext, useContext, useState, useEffect } from "react";
import { fetchMe } from "@/api/auth";

// Context作成
const LoginContext = createContext();

// Providerを作成
export const LoginProvider = ({ children }) => {
    const [user, setUser] = useState(null); // nullなら未ログイン
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const init = async () => {
            try {
                const me = await fetchMe();
                setUser(me);
            } catch {
                setUser(null);
            } finally {
                setLoading(false);
            }
        };
        init();
    }, []);

    return (
        <LoginContext.Provider value={{ user, setUser, loading }}>
            {children}
        </LoginContext.Provider>
    );
};

// Contextを簡単に使えるカスタムフック
export const useLogin = () => {
    const context = useContext(LoginContext);
    if ( !context ) {
        throw new Error("useLoginはLoginProvider内で使用する必要があります");
    }
    return context;
};
