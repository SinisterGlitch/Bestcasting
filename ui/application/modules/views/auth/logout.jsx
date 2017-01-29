'use strict';

import React from 'react';
import Reflux from 'reflux';
import AuthStore from 'stores/auth';
import {PageHeader} from 'react-bootstrap';

export default React.createClass({

    mixins: [
        Reflux.listenTo(AuthStore, 'onLogout'),
    ],

    componentDidMount() {
        AuthStore.unLoadUser();
    },

    onLogout() {
        this.props.router.push({pathname: '/login'});
    },

    render(){
        return (
            <PageHeader>Account <small>Unloading user</small></PageHeader>
        )
    }
});