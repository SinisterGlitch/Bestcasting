'use strict';

import React from 'react';
import Reflux from 'reflux';
import NotificationStore from 'stores/notification';
import NotificationActions from 'actions/notification';

export default React.createClass({

    mixins: [
        Reflux.listenTo(NotificationStore, 'forceUpdate')
    ],

    getMessage() {
        let result = null;
        let status = NotificationStore.getStatus();

        if (status >= 400 && status < 500) {
            result = 'error';
        } else if (status >= 200 && status < 300) {
            result ='success';
        }

        if (NotificationStore.getMessage()) {
            result = NotificationStore.getMessage();
        }

        return result;
    },

    getClassName() {
        let status = NotificationStore.getStatus();

        if (status >= 400 && status < 500) {
            return 'alert alert-danger';
        } else if (status >= 200 && status < 300) {
            return 'alert alert-success';
        }
    },

    render() {
        return (
            <div onClick={NotificationActions.hide}
                 style={{cursor:'pointer', display: !(NotificationStore.getStatus()) ? 'none' : 'block'}}
                 className={this.getClassName()}>
                    {this.getMessage()}
            </div>
        );
    }
});