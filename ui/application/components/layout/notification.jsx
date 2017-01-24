'use strict';

import React from 'react';
import Reflux from 'reflux';
import NotificationScreen from 'stores/notification';
import NotificationActions from 'actions/notification';

export default React.createClass({

    mixins: [
        Reflux.listenTo(NotificationScreen, 'forceUpdate')
    ],

    getMessage() {
        let status = NotificationScreen.getStatus();

        if (status >= 400 && status < 500) {
            return 'error';
        } else if (status >= 200 && status < 300) {
            return 'success';
        }
    },

    getClassName() {
        let status = NotificationScreen.getStatus();

        if (status >= 400 && status < 500) {
            return 'alert alert-danger';
        } else if (status >= 200 && status < 300) {
            return 'alert alert-success';
        }
    },

    render() {
        return (
            <div onClick={NotificationActions.hide}
                 style={{cursor:'pointer', display: !(NotificationScreen.getStatus()) ? 'none' : 'block'}}
                 className={this.getClassName()}>
                    {this.getMessage()}
            </div>
        );
    }
});