// 当日の出席状況と現在の出席状況を出力する
import styles from "./AttendanceItem.module.css";

function AttendanceItem({ status, className, time, date }) {
    // ステータスによるクラス名
    const statusClass = styles[status] || styles.gray;

    // 表示用テキスト
    const statusText = {
        present: "出席",
        absent: "欠席",
        late: "遅刻",
        early_leave: "早退",
        excused: "公欠",
    }[status] || status;

    return (
        <div className={styles.container }>
            <div className={`${styles.status} ${statusClass}`}>
                <p>{statusText}</p>
            </div>
            <div className={styles.info}>
                <div className={styles.className}><h3>授業 {className} {time}</h3></div>
                <div className={styles.dateTime}><p>日付 {date}</p></div>
            </div>
        </div>
    );
    }

export default AttendanceItem;

