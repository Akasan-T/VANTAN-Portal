import { BrowserRouter } from "react-router-dom";
import AppRoutes from "./routes/AppRoutes";
import { LoginProvider } from "./context/LoginContext";

function App() {
  return (
    <BrowserRouter>
      <LoginProvider>
        <AppRoutes />
      </LoginProvider>
    </BrowserRouter>
  );
}

export default App;
