// 生徒側ページ共通レイアウト
import { Outlet } from "react-router-dom";

function UserLayout() {
    return (
        <>
            <Header/>

            <main>
                <Outlet/>
            </main>
        </>
    )
}

export default UserLayout;