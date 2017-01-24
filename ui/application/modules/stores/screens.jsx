'use strict';

import React from 'react';
import Reflux from'reflux';
import _ from 'lodash';

import ScreensActions from 'modules/actions/screens';

export default Reflux.createScreen({
    listenables: ScreensActions,

    /**
     * @var {Array}
     */
    _screens: [],

    /**
     * @param {Array} screens
     */
    loadScreensCompleted(screens) {
        _.forEach(screens, screen => this._screens[screen.id] = screen);
        this.trigger();
    },

    /**
     * @param {Object} screen
     */
    loadScreenCompleted(screen) {
        this._screens[screen.id] = screen;
        this.trigger();
    },

    /**
     * @return {Array}
     */
    getScreens() {
        return this._screens;
    },

    /**
     * @return {Object}
     */
    getScreen(id) {
        return _.has(this._screens, id) ? this._screens[id] : '';
    }
});