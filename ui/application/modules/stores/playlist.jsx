'use strict';

import React from 'react';
import Reflux from'reflux';
import _ from 'lodash';

import PlaylistsActions from 'modules/actions/playlists';

export default Reflux.createPlaylist({
    listenables: PlaylistsActions,

    /**
     * @var {Array}
     */
    _playlists: [],

    /**
     * @param {Array} playlists
     */
    loadPlaylistsCompleted(playlists) {
        _.forEach(playlists, playlist => this._playlists[playlist.id] = playlist);
        this.trigger();
    },

    /**
     * @param {Object} playlist
     */
    loadPlaylistCompleted(playlist) {
        this._playlists[playlist.id] = playlist;
        this.trigger();
    },

    /**
     * @return {Array}
     */
    getPlaylists() {
        return this._playlists;
    },

    /**
     * @return {Object}
     */
    getPlaylist(id) {
        return _.has(this._playlists, id) ? this._playlists[id] : '';
    }
});