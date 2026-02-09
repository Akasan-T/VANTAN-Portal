import PageTitle from "../../components/user/Page/PageTitle";

// 生徒側ログインページ
function StudentLoginForm({ onSubmit, loading, error }) {
    return (
        <>
            <PageTitle title="ログイン"/>
            <form
            onSubmit={(e) => {
                e.preventDefault();
                onSubmit(
                e.target.email.value,
                e.target.password.value
                );
            }}
            >
            <input name="email" placeholder="学生用メール" />
            <input type="password" name="password" />
            {error && <p>{error}</p>}
            <button disabled={loading}>ログイン</button>
            </form>
        </>
    );
}

export default StudentLoginForm;
