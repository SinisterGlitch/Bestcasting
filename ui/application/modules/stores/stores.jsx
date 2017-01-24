'use strict';

import React from 'react';
import Reflux from'reflux';
import _ from 'lodash';

import StoresActions from 'modules/actions/stores';

export default Reflux.createStore({
    listenables: StoresActions,

    /**
     * @var {Array}
     */
    _stores: [],

    /**
     * @param {Array} stores
     */
    loadStoresCompleted(stores) {
        _.forEach(stores, store => this._stores[store.id] = store);
        this.trigger();
    },

    /**
     * @param {Object} store
     */
    loadStoreCompleted(store) {
        this._stores[store.id] = store;
        this.trigger();
    },

    /**
     * @return {Array}
     */
    getStores() {
        return this._stores;
    },

    /**
     * @return {Object}
     */
    getStore(id) {
        return _.has(this._stores, id) ? this._stores[id] : '';
    }
});