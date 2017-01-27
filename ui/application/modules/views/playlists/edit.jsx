'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

import PlaylistsStore from 'modules/stores/playlists';
import PlaylistsActions from 'modules/actions/playlists';

export default React.createClass({

    mixins: [
        StateMixin,
        Reflux.listenTo(PlaylistsStore, 'onLoadPlaylist')
    ],

    componentDidMount() {
        PlaylistsActions.loadPlaylist(this.props.params.id)
    },

    getInitialState() {
        return {
            playlist: {}
        };
    },

    onLoadPlaylist() {
        this.setState({
            playlist: PlaylistsStore.getPlaylist(this.props.params.id)
        });
    },

    onSubmit() {
        PlaylistsActions.updatePlaylist(this.props.params.id, this.state.playlist);
    },

    render(){
        return (
            <div key="content">
                <TextInput label="Name" valueLink={this.linkState('playlist.name')} />
                <br/>
                <TextInput label="Description" valueLink={this.linkState('playlist.description')} />
                <br/>
                <Submit value="Save" onClick={this.onSubmit} />
            </div>
        );
    }
});