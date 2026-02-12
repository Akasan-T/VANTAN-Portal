// 1席分の表示コンポーネント
import ActionButton from "../../../components/Button/ActionButton";

function SeatItem({ seat, submitting, onSelect }) {

    // APIレスポンス差異に対応
    const isTaken =
        seat.is_taken ?? seat.taken ?? false;

    const seatLabel =
        seat.seat_code ??
        seat.number ??
        seat.id;

    return (
        <div
            style={{
                border: "1px solid #ccc",
                padding: "10px",
                textAlign: "center",
            }}
        >
            <div>{seatLabel}</div>

            <ActionButton
                variant={isTaken ? "secondary" : "student"}
                size="sm"
                disabled={isTaken || submitting}
                onClick={() => onSelect(seat.id)}
            >
                {isTaken ? "×" : "出席"}
            </ActionButton>
        </div>
    );
}

export default SeatItem;
