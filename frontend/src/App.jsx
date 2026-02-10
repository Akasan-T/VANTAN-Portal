import { BrowserRouter } from "react-router-dom";
import AppRoutes from "./routes/AppRoutes";
import { LoginProvider } from "@/context/LoginContext";

function App() {
  return (
    <LoginProvider>
      <BrowserRouter>
          <AppRoutes />
      </BrowserRouter>
    </LoginProvider>
  );
}

export default App;
