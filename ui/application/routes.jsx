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

// attribute
import attributeListView from 'modules/views/attribute/list';
import attributeDetailView from 'modules/views/attribute/detail';
import attributeEditView from 'modules/views/attribute/edit';
import attributeNewView from 'modules/views/attribute/new';

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

                <Route component={attributeListView} path="/attribute" />
                <Route component={attributeDetailView} path="/attribute/detail/:id" />
                <Route component={attributeEditView} path="/attribute/edit/:id" />
                <Route component={attributeNewView} path="/attribute/new" />

                <Route path="*" component={authNotFoundView}/>
            </Route>
        </Route>
    </Router>
);