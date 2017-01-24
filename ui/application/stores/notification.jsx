'use strict';

import React from 'react';
import Reflux from 'reflux';
import NotificationActions from 'actions/notification';

export default Reflux.createStore({
    listenables: NotificationActions,

    /**
     * @import {int}
     */
    status: null,

    /**
     * @import {string}
     */
    method: null,

    /**
     * @param {int} status
     * @param {string} method
     */
    onShow(status, method) {
        if (method == 'GET') {
            return;
        }

        this.status = status;
        this.method = method;
        setTimeout(NotificationActions.hide, 3000);
        this.trigger();
    },

    onHide() {
        this.status = null;
        this.trigger();
    },

    /**
     * @return {int}
     */
    getStatus() {
        return this.status;
    }
});