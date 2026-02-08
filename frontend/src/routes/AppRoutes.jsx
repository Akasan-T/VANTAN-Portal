import { Routes , Route } from "react-router-dom";

// layouts
import UserLayout from "../layouts/UserLayout";
import AdminLayout from "../layouts/AdminLayout";
import TeacherLayout from "../layouts/TeacherLayout";

// pages
import Login from "../pages/Auth/Login";

function AppRoutes() {
    return (
        <Routes>
            {/* ログイン */}
            {/* User Teacher Admin共通 */}
            <Route path="/login" element={<Login/>}/>

            {/* User */}
            <Route element={<UserLayout/>}>
                <Route path="/top" element={<Top/>}/>
            </Route>

            {/* Teacher */}
            {/* 教師ページパスはここ */}
            <Route path="/teacher" element={<TeacherLayout/>}>
            
            </Route>
            
            {/* Admin */}
            {/* 管理者ページパスはここ */}
            <Route path="/admin" element={<AdminLayout/>}>
            
            </Route>
        </Routes>
    );
}

export default AppRoutes;