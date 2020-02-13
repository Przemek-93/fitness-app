import React, {Component} from "react";

import '../../styles/layouts/Header.css';

class Header extends Component {

    state = {
        showMenu: true
    };

    toggleMenu = () => {
        this.setState({
            showMenu: !this.state.showMenu
        })
    };

    render() {

        return (
            <>
                <button className="toggle-left" onClick={this.toggleMenu}>
                        <span className="icon-middle">
                            <i className="fa fa-bars"></i>
                        </span>
                </button>
            </>
        )
    }
}


export default Header
