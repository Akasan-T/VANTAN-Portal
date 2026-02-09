import { Routes , Route } from "react-router-dom";

// layouts
import LoginLayout from "../layouts/LoginLayout";
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
            {/* 生徒側 */}
            <Route path="/login" element={<LoginLayout role="student"/>}>
                <Route path="student" element={<Login role="student"/>} />
            </Route>
            {/* 教師側 */}
            <Route path="/login" element={<LoginLayout role="teacher" />}>
                <Route path="teacher" element={<Login role="teacher" />} />
            </Route>

            {/* 生徒ページ */}
            <Route path="/student" element={<StudentLayout/>}>
                <Route path="top" element={<Top/>}/>
                <Route path="attendance" element={<AttendanceTop/>}/>
                <Route path="attendance/seat" element={<SeatSelection/>}/>
            </Route>

            {/* 教師ページ */}
            {/* 教師ページパスはここ */}
            <Route path="/teacher" element={<TeacherLayout/>}>
            
            </Route>
        </Routes>
    );
}

export default AppRoutes;