'use strict';

import React from 'react';
import Reflux from 'reflux';
import NotificationStore from 'stores/notification';
import NotificationActions from 'actions/notification';
import {ListGroup, ListGroupItem} from 'react-bootstrap';

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
            return 'danger';
        } else if (status >= 200 && status < 300) {
            return 'success';
        }
    },

    render() {
        return (
            <ListGroup onClick={NotificationActions.hide} style={{cursor:'pointer', display: !(NotificationStore.getStatus()) ? 'none' : 'block'}}>
                <ListGroupItem bsStyle={this.getClassName()}>{this.getMessage()}</ListGroupItem>
            </ListGroup>
        );
    }
});