// ログインする画面
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import LoginForm from "./LoginForm";
import { login } from "@/api/auth";

function Login() {
    const navigate = useNavigate();
    const [roleUI, setRoleUI] = useState("student");

    const handleSubmit = async (e) => {
        e.preventDefault();
        const email = e.target.email.value;
        const password = e.target.password.value;

        try {
            const user = await login(email, password);

            if (user.role === "student") navigate("/student/top");
            if (user.role === "teacher") navigate("/teacher");
            if (user.role === "staff") navigate ("/staff");
        } catch {
            alert("ログイン失敗");
        }
    };

    return <LoginForm></LoginForm>
}

export default Login;