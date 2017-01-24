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
     * @import {string}
     */
    message: null,

    /**
     * @param {int} status
     * @param {string} method
     * @param {string} message
     */
    onShow(status, method, message = null) {
        if (method == 'GET' && status >= 200 && status < 300) {
            return;
        }

        this.status = status;
        this.method = method;
        this.message = message;

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
    },

    /**
     * @return {int}
     */
    getMessage() {
        return this.message;
    }
});