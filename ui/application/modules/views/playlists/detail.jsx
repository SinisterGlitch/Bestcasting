'use strict';

import React from 'react';
import Reflux from 'reflux';
import _ from 'lodash';

import PlaylistsStore from 'modules/stores/playlists';
import PlaylistsActions from 'modules/actions/playlists';

export default React.createClass({

    mixins: [
        Reflux.listenTo(PlaylistsStore, 'onLoadPlaylist')
    ],

    componentDidMount() {
        if (_.isEmpty(PlaylistsStore.getPlaylist(this.props.params.id))) {
            PlaylistsActions.loadPlaylist(this.props.params.id);
        }
    },

    getInitialState() {
        return {
            playlist: PlaylistsStore.getPlaylist(this.props.params.id)
        }
    },

    onLoadPlaylist() {
        this.setState({
            playlist: PlaylistsStore.getPlaylist(this.props.params.id)
        });
    },

    render(){
        return (
            <div key="content">
                {!_.isEmpty(this.state.playlist) ? this.state.playlist.id+' | '+this.state.playlist.name : ''}
            </div>
        )
    }
});