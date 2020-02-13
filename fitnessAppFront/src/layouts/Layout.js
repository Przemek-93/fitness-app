import React, {Component} from 'react';
import {Row, Col } from 'reactstrap';
import {BrowserRouter as Router} from 'react-router-dom';

import '../styles/layouts/Layout.css';
import Navbar from "./Navbar";
import Page from "./Page";
import Aside from "./Aside";

class Layout extends Component {
    render() {
        return (
            <Router>
                <div className="container-fluid">
                    <Row className="header">
                        {<Navbar/>}
                    </Row>

                    <Row className="main">
                        <Col md={2} className="aside">
                            {<Aside/>}
                        </Col>

                        <Col md={10} className="page">
                            {<Page/>}
                        </Col>
                    </Row>
                </div>
            </Router>
        );
    }
}

export default Layout;
