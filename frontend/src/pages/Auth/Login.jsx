// ログイン機能の役割
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { login } from "@/api/auth";
import StudentLoginForm from "./StudentLoginForm";
import TeacherLoginForm from "./TeacherLoginForm";

function Login({ role }) {
    const navigate = useNavigate();
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState("");

    const handleSubmit = async (email, password) => {
        setLoading(true);
        setError("");

        try {
            const user = await login(email, password);

            if (user.role !== role) {
                throw new Error("役割の不一致")
            } 
            if (user.role === "student") navigate("/student/top");
            if (user.role === "teacher") navigate("/teacher");
        } catch {
            setError("ログインに失敗しました");
        } finally {
            setLoading(false);
        }
    };

    if (role === "student") {
        return (
            <StudentLoginForm
                onSubmit={handleSubmit}
                loading={loading}
                error={error}
            />
        );
    }

    if (role === "teacher") {
        return (
            <TeacherLoginForm
                onSubmit={handleSubmit}
                loading={loading}
                error={error}
            />
        );
    }
}

export default Login;