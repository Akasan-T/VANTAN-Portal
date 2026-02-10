import LoginForm from "../../components/Auth/LoginForm";
import PageTitle from "../../components/user/Page/PageTitle";

// 教師側ログインページ
function TeacherLoginForm({ onSubmit, loading, error }) {
    return (
        <>
            <PageTitle title="ログイン" role="teacher"/>

            <LoginForm
                onSubmit={onSubmit}
                loading={loading}
                error={error}
                role="teacher"
            />
        </>
        
    );
}

export default TeacherLoginForm;
