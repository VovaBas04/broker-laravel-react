import './App.css';
import SignIn from "./pages/signin/SignIn";
import RouteApp from "./router/Router"
import Echo from "laravel-echo";
import {useEffect} from "react";
window.io = require('socket.io-client')
export const echo = new Echo({
    broadcaster:'socket.io',
    host:window.location.hostname+':6001',
});
function App() {
        return <RouteApp></RouteApp>
}

export default App;
