import LoginForm from "../../components/Auth/LoginForm";
import PageTitle from "../../components/user/Page/PageTitle";

// 生徒側ログインページ
function StudentLoginForm({ onSubmit, loading, error, role }) {
    return (
        <>
            <PageTitle title="ログイン" role="student"/>
            
            <LoginForm
                onSubmit={onSubmit}
                loading={loading}
                error={error}
                role="student"
            />
        </>
    );
}

export default StudentLoginForm;
