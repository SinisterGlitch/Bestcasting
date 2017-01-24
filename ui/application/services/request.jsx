'use strict';

import SuperAgent from 'superagent';
import NotificationActions from 'actions/notification';
import AuthStore from 'stores/auth';
import Constants from 'constants';

export default {

    /**
     * @param {string} url
     * @param {func} callback
     */
    get(url, callback) {
        SuperAgent
            .get(Constants.API_PREFIX + url)
            .set('authorization', AuthStore.getToken())
            .end((err, res) => this.responseHandler(res, callback));
    },

    /**
     * @param {string} url
     * @param {array} data
     * @param {func} callback
     */
    post(url, data, callback) {
        SuperAgent
            .post(Constants.API_PREFIX + url, data)
            .set('authorization', AuthStore.getToken())
            .end((err, res) => this.responseHandler(res, callback));
    },

    /**
     * @param {string} url
     * @param {array} data
     * @param {func} callback
     */
    put(url, data, callback) {
        SuperAgent
            .put(Constants.API_PREFIX + url, data)
            .set('authorization', AuthStore.getToken())
            .end((err, res) => this.responseHandler(res, callback));
    },

    /**
     * @param {string} url
     * @param {array} data
     * @param {func} callback
     */

    patch(url, data, callback) {
        SuperAgent
            .patch(Constants.API_PREFIX + url, data)
            .set('authorization', AuthStore.getToken())
            .end((err, res) => this.responseHandler(res, callback));
    },

    /**
     * @param {string} url
     * @param {array} data
     * @param {func} callback
     */
    delete(url, data, callback) {
        SuperAgent
            .del(Constants.API_PREFIX + url, data)
            .set('authorization', AuthStore.getToken())
            .end((err, res) => this.responseHandler(res, callback));
    },

    /**
     * @param {object} response
     * @param {func} callback
     */
    responseHandler(response, callback) {
        response.ok
            ? callback.completed(response.body)
            : callback.failed(response.text);

        NotificationActions.show(response.status, response.req.method);
    }
};