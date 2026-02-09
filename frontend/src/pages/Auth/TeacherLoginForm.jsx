// 教師側ログインページ
function TeacherLoginForm({ onSubmit, loading, error }) {
    return (
        <form
        onSubmit={(e) => {
            e.preventDefault();
            onSubmit(
            e.target.email.value,
            e.target.password.value
            );
        }}
        >
        <h1>教師ログイン</h1>

        <input name="email" placeholder="教職員メール" />
        <input type="password" name="password" />

        {error && <p>{error}</p>}

        <button disabled={loading}>ログイン</button>
        </form>
    );
}

export default TeacherLoginForm;
