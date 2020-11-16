import React, {Component} from 'react';
import {Route, Switch} from 'react-router-dom';

import Dashboard from '../views/pages/dashboard/Dashboard';
import TrainingPlans from '../views/pages/trainings/TrainingPlans';
import MyActivity from '../views/pages/trainings/MyActivity';
import DietPlans from '../views/pages/feed/DietPlans';
import MyDiet from '../views/pages/feed/MyDiet';
import Metamorph from '../views/pages/efects/Metamorph';
import Measure from '../views/pages/efects/Measure';
import Settings from '../views/pages/settings/Settings';
import MyAccount from '../views/pages/settings/MyAccount';
import Error from '../views/pages/error/Error';

class Page extends Component {

    render () {

        return (
            <>
                <Switch>
                    <Route path="/dashboard" exact component={Dashboard}/>
                    <Route path="/trainings/plan" component={TrainingPlans}/>
                    <Route path="/trainings/my-activity" component={MyActivity}/>
                    <Route path="/diet/plan" component={DietPlans}/>
                    <Route path="/diet/my-diet" component={MyDiet}/>
                    <Route path="/effects/changes" component={Metamorph}/>
                    <Route path="/effects/measure" component={Measure}/>
                    <Route path="/settings" component={Settings}/>
                    <Route path="/my-account" component={MyAccount}/>
                    <Route exact component={Error}/>
                </Switch>
            </>
        )
    }
}

export default Page
