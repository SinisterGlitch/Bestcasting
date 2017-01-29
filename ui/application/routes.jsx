'use strict';

import React from 'react';
import {Router, Route, browserHistory, IndexRoute} from 'react-router';

import App from 'components/layout/app';
import Base from 'components/layout/base';
import AuthStore from 'stores/auth';

// Auth
import authNotFoundView from 'modules/views/auth/404';
import authLoginView from 'modules/views/auth/login';
import authLogoutView from 'modules/views/auth/logout';
import authRegisterView from 'modules/views/auth/register';

// dashboard
import dashboardIndexView from 'modules/views/dashboard/index';

// stores
import storesListView from 'modules/views/stores/list';
import storesDetailView from 'modules/views/stores/detail';
import storesEditView from 'modules/views/stores/edit';
import storesNewView from 'modules/views/stores/new';

let validate = (nextState, location) => {
    if (!AuthStore.getToken()) {
        location('/login')
    }
};

export default (
    <Router history={browserHistory}>
        <Route component={Base} path="/">
            <Route component={authLoginView} path="login" />
            <Route component={authLogoutView} path="logout" />
            <Route component={authRegisterView} path="register" />

            <Route component={App} path="/dashboard" onEnter={validate}>
                <IndexRoute component={dashboardIndexView}/>

                <Route component={storesListView} path="/stores" />
                <Route component={storesDetailView} path="/stores/detail/:id" />
                <Route component={storesEditView} path="/stores/edit/:id" />
                <Route component={storesNewView} path="/stores/new" />

                <Route path="*" component={authNotFoundView}/>
            </Route>
        </Route>
    </Router>
);