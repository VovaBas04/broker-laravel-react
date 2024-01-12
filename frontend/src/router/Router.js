import React from "react";
import {BrowserRouter,Routes,Route,Link} from "react-router-dom";
import SignIn from "../pages/signin/SignIn";
import SignUp from "../pages/createuser/CreateUser";
import ListUser from "../pages/listuser/ListUser";
import ListStock from '../pages/stock/ListStock'
import Settings from '../pages/setting/Settings'
import Graph from "../pages/graph/Graph";
export default function RouteApp()
    {
        return (
            <BrowserRouter>
                    <Routes>
                        <Route exact path="/" element={<Home/>}></Route>
                        <Route exact path="/signin" element={<SignIn/>}></Route>
                        <Route exact path="/signup" element={<SignUp/>}></Route>
                        <Route path="/about" element={<About/>}></Route>
                        <Route path="/dashboard" element={<ListUser/>}></Route>
                        <Route path="/stocks" element={<ListStock/>}></Route>
                        <Route path="/settings" element={<Settings/>}></Route>
                        <Route path="/graph/:id" element={<Graph/>}></Route>
                        <Route path="*" element={<NoMatch/>}></Route>
                    </Routes>
            </BrowserRouter>
        );
    }

function Home() { return <div><h3>Home</h3></div> } function About() { return <div><h3>About</h3></div> } function NoMatch() { return <div><h3>No match!</h3></div> }