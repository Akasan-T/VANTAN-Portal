const API_URL = "http://localhost:8000/api";

export const login = async (email, password) => {
    const res = await fetch(`${API_URL}/login`, {
        method:'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password }),
    });

    if (!res.ok) {
        throw new Error ("ログイン失敗");
    }
    
    const data = await res.json();

    localStorage.setItem('token', data.token);
    localStorage.setItem('user', JSON.stringify(data.user));

    return data.user;
};

export const getUser = () => {
    const user = localStorage.getItem("user");
    return user ? JSON.parse(user) : null;
};

export const isLoggedIn = () => {
    return !!localStorage.getItem("token");
};

export const logout = () => {
    localStorage.clear();
}