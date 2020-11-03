import React, {Component} from "react";
import {NavLink} from "react-router-dom";

import '../styles/layouts/Aside.css';
import avatar from '../img/avatar.png';


class Aside extends Component {

    render() {
        const username = (JSON.parse(localStorage.user).username)
        return (
            <>
                <div className="sidebar">
                    <div className="welcome-box">
                        <div className="hello">
                            Witaj <br />
                            <strong>{username.toUpperCase()}</strong>
                        </div>
                        <div className="avatar">
                            <img src={avatar} className="media-object img-thumbnail user-img rounded-circle admin_img3" alt="avatar"/>
                        </div>
                    </div>
                    <ul className="nav-list">
                        <li className="nav-item">
                            <NavLink to={"/dashboard"} exact={true}><i className="fas fa-tachometer-alt"/><span className="nav-item-title">Pulpit</span></NavLink>
                        </li>

                        <h6 className="nav-title">Treningi</h6>

                        <li className="nav-item">
                            <NavLink to={"/trenings/plan"} exact={false}><i className="fas fa-columns"></i><span className="nav-item-title">Plan treningowy</span></NavLink>
                        </li>
                        <li className="nav-item">
                            <NavLink to={"/trenings/my-activity"} exact={false}><i className="fas fa-running"></i><span className="nav-item-title">Moja aktywność</span></NavLink>
                        </li>

                        <h6 className="nav-title">Odżywianie</h6>
                        <li className="nav-item">
                            <NavLink to={"/diet/plan"} exact={false}><i className="fas fa-columns"></i><span className="nav-item-title">Plan odżywiania</span></NavLink>
                        </li>
                        <li className="nav-item">
                            <NavLink to={"/diet/my-diet"} exact={false}><i className="fas fa-utensils"></i><span className="nav-item-title">Moja dieta</span></NavLink>
                        </li>

                        <h6 className="nav-title">Efekty</h6>
                        <li className="nav-item">
                            <NavLink to={"/efects/changes"} exact={false}><i className="fas fa-exchange-alt"></i><span className="nav-item-title">Metamorfozy</span></NavLink>
                        </li>
                        <li className="nav-item">
                            <NavLink to={"/efects/measure"} exact={false}><i className="fas fa-balance-scale-right"></i><span className="nav-item-title">Pomiary</span></NavLink>
                        </li>
                    </ul>
                </div>
            </>
        )
    }
}


export default Aside
