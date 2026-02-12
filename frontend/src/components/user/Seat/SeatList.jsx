// 座席一覧表示コンポーネント
import SeatItem from "./SeatItem";

function SeatList({ seats, submitting, onSelect }) {

    return (
        <div
            style={{
                display: "grid",
                gridTemplateColumns: "repeat(6, 1fr)",
                gap: "12px",
            }}
        >
            {seats.map((seat) => (
                <SeatItem
                    key={seat.id}
                    seat={seat}
                    submitting={submitting}
                    onSelect={onSelect}
                />
            ))}
        </div>
    );
}

export default SeatList;
