'use strict';

import React from 'react';
import {Router, Route} from 'react-router';
import App from 'components/layout/app';

import createBrowserHistory from 'history/lib/createBrowserHistory';
let history = createBrowserHistory();

// dashboard
import notFoundView from 'modules/views/dashboard/not-found';
import dashboardIndexView from 'modules/views/dashboard/index';
import dashboardLoginView from 'modules/views/dashboard/login';
import dashboardRegisterView from 'modules/views/dashboard/register';

// stores
import storesListView from 'modules/views/stores/list';
import storesDetailView from 'modules/views/stores/detail';
import storesEditView from 'modules/views/stores/edit';
import storesNewView from 'modules/views/stores/new';

// screens
import screensListView from 'modules/views/screens/list';
import screensDetailView from 'modules/views/screens/detail';
import screensEditView from 'modules/views/screens/edit';
import screensNewView from 'modules/views/screens/new';

// playlists
import playlistsListView from 'modules/views/playlists/list';
import playlistsDetailView from 'modules/views/playlists/detail';
import playlistsEditView from 'modules/views/playlists/edit';
import playlistsNewView from 'modules/views/playlists/new';

// slides
import slidesListView from 'modules/views/slides/list';
import slidesDetailView from 'modules/views/slides/detail';
import slidesEditView from 'modules/views/slides/edit';
import slidesNewView from 'modules/views/slides/new';

export default (
    <Router history={history}>
        <Route component={App} path="/">
            <Route component={dashboardLoginView} path="dashboard/login" />
            <Route component={dashboardIndexView} path="dashboard" />
            <Route component={dashboardRegisterView} path="dashboard/register" />

            <Route component={storesListView} path="stores" />
            <Route component={storesDetailView} path="stores/detail/:id" />
            <Route component={storesEditView} path="stores/edit/:id" />
            <Route component={storesNewView} path="stores/new" />

            <Route component={screensListView} path="screens" />
            <Route component={screensDetailView} path="screens/detail/:id" />
            <Route component={screensEditView} path="screens/edit/:id" />
            <Route component={screensNewView} path="screens/new" />

            <Route component={playlistsListView} path="playlists" />
            <Route component={playlistsDetailView} path="playlists/detail/:id" />
            <Route component={playlistsEditView} path="playlists/edit/:id" />
            <Route component={playlistsNewView} path="playlists/new" />

            <Route component={slidesListView} path="slides" />
            <Route component={slidesDetailView} path="slides/detail/:id" />
            <Route component={slidesEditView} path="slides/edit/:id" />
            <Route component={slidesNewView} path="slides/new" />

            <Route path="*" component={notFoundView}/>
        </Route>
    </Router>
);