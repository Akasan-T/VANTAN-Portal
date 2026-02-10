// ログインフォーム
import styles from "./LoginForm.module.css";
import ActionButton from "../Button/ActionButton";

function LoginForm ({ onSubmit, loading, error}) {
    return (
        <form 
            onSubmit={(e) => {
                e.preventDefault();
                onSubmit(
                    e.target.email.value,
                    e.target.password.value
                );
            }}
            className={styles.from}
        >
            <input 
                name="email" 
                placeholder="メールアドレス"
                required
            />

            <input 
                type="password"
                name="password"
                placeholder="パスワード"
                required
            />

            {error && <p>{error}</p>}

            <ActionButton
                type="submit"
                disabled={loading}
                variant="primary"
            >
                {loading ? "ログイン中…" : "ログイン"}
            </ActionButton>
        </form>
    );
}

export default LoginForm;