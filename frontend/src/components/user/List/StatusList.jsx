// 出席・公欠申請のアイテムを入れるリスト
import AttendanceItem from "../Attendance/AttendanceItem";

function StatusList({ attendances }) {
    if (!attendances || attendances.length === 0) {
        return <p>今日の出席情報はありません。</p>;
    }

    return (
        <div>
            {attendances.map((att, index) => (
                <AttendanceItem
                key={index}
                status={att.status}
                className={att.class_name}
                time={att.time}
                date={att.date}
                />
            ))}
        </div>
    );
}

export default StatusList;
