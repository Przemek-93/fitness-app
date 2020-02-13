import React from 'react';
import {NavLink} from 'react-router-dom';

import '../styles/layouts/Header.css';

import Header from "../components /header/Header";

const Navbar  = () => {
    return (
        <>
            <div className="header-bar">
                <div className="left-box">
                    <NavLink to={"/dashboard"} exact={false}>
                        <span className="navbar-brand">
                            <i className="fas fa-running fa-2x"/><h5 className="logotype">Fitness App</h5>
                        </span>
                    </NavLink>

                    <Header />
                </div>

                <div className="right-box">
                    <NavLink to={"/my-account"} exact={false}>
                        <span className="navbar-brand"><i className="fas fa-user-circle"></i><span className="logotype">Moje konto</span></span>
                    </NavLink>

                    <NavLink to={"/settings"} exact={false}>
                        <span className="navbar-brand"><i className="fas fa-cogs"></i><span className="logotype">Ustawienia</span></span>
                    </NavLink>
                </div>

            </div>
        </>
    )
};

export default Navbar
