import React, {Component} from 'react';
import {Route, Switch} from 'react-router-dom';
import {BrowserRouter as Router} from 'react-router-dom';
import {isAuthenticated} from './utils/auth';

import './styles/App.css';

import Layout from "./layouts/Layout";
import Login from "./views/pages/login /Login"
import Register from "./views/pages/register/Register"

const loading = () => <div className="animated fadeIn pt-3 text-center">Loading...</div>;

class App extends Component {
    render() {
        return (
            <>
                <Router>
                    <React.Suspense fallback={loading()}>
                        <Switch>
                            {isAuthenticated(sessionStorage.user) && <Route path="/" exact component={Layout}/>}
                            <Route path="/login" component={Login}/>
                            <Route path="/register" component={Register}/>
                        </Switch>
                    </React.Suspense>
                </Router>
            </>
        )
    }
}

export default App
