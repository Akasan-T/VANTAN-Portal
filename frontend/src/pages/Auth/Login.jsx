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

            if (role === "student") navigate("/student/top");
            if (role === "teacher") navigate("/teacher/top");
        } catch (err) {
            setError(err.message || "ログインに失敗しました");
        } finally {
            setLoading(false);
        }
    };

    return role === "student" ? (
        <StudentLoginForm onSubmit={handleSubmit} loading={loading} error={error} />
    ) : (
        <TeacherLoginForm onSubmit={handleSubmit} loading={loading} error={error} />
    );
}

export default Login;