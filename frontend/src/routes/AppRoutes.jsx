import { Routes , Route } from "react-router-dom";

// layouts
import StudentLayout from "../layouts/StudentLayout";
import TeacherLayout from "../layouts/TeacherLayout";

// pages
import Login from "../pages/Auth/Login";

    // student
import Top from "../pages/Student/Top";
import AttendanceTop from "../pages/Student/Attendance/AttendanceTop";
import SeatSelection from "../pages/Student/Attendance/SeatSelection";

function AppRoutes() {
    return (
        <Routes>
            {/* ログイン */}
            {/* User Teacher Admin共通 */}
            <Route path="/login" element={<Login/>}/>

            {/* Student */}
            <Route path="/student" element={<StudentLayout/>}>
                <Route path="top" element={<Top/>}/>
                <Route path="attendance" element={<AttendanceTop/>}/>
                <Route path="attendance/seat" element={<SeatSelection/>}/>
            </Route>

            {/* Teacher */}
            {/* 教師ページパスはここ */}
            <Route path="/teacher" element={<TeacherLayout/>}>
            
            </Route>
        </Routes>
    );
}

export default AppRoutes;