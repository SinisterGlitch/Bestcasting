'use strict';

import React from 'react';
import Notification from 'components/layout/notification';
import Navigation from 'components/layout/navigation';
import AuthStore from 'stores/auth';

export default React.createClass({

    hasAccess() {
        if (!AuthStore.getToken() && !this.props.router.location.pathname != '/dashboard/login') {
            // this.props.router.push({pathname: '/dashboard/login'});
        }
    },

    render() {
        this.hasAccess();
        return (
            <div>
                <Navigation />
                <Notification/>
                <div className="container">
                    {this.props.children}
                </div>
            </div>
        );
    }
});