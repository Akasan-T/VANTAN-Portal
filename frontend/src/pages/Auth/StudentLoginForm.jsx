import LoginForm from "../../components/user/Auth/LoginForm";
import PageTitle from "../../components/user/Page/PageTitle";

// 生徒側ログインページ
function StudentLoginForm({ onSubmit, loading, error }) {
    return (
        <>
            <PageTitle title="ログイン"/>
            
            <LoginForm
                onSubmit={onSubmit}
                loading={loading}
                error={error}
            />
        </>
    );
}

export default StudentLoginForm;
