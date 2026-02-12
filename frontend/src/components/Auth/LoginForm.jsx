// ログインフォーム
import styles from "./LoginForm.module.css";
import ActionButton from "../Button/ActionButton";

function LoginForm ({ onSubmit, loading, error, role}) {
    const variant = role;
    const inputClass = `${styles.input} ${styles[role]}`;

    return (
        <form 
            onSubmit={(e) => {
                e.preventDefault();
                onSubmit(
                    e.target.email.value,
                    e.target.password.value
                );
            }}
            className={styles.form}
        >
            <input 
                name="email" 
                placeholder="メールアドレス"
                required
                className={inputClass}
            />

            <input 
                type="password"
                name="password"
                placeholder="パスワード"
                required
                className={inputClass}
            />

            {error && <p>{error}</p>}

            <ActionButton
                type="submit"
                disabled={loading}
                variant={variant}
                size="lg"
            >
                {loading ? "ログイン中…" : "ログイン"}
            </ActionButton>
        </form>
    );
}

export default LoginForm;