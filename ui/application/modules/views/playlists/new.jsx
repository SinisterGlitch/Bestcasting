'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

import AuthStore from 'stores/auth';
import PlaylistsActions from 'modules/actions/playlists';

export default React.createClass({

    mixins: [
        Reflux.listenTo(PlaylistsActions.createPlaylist.completed, 'onSave'),
        StateMixin
    ],

    getInitialState() {
        return {
            playlist: {
                active: false,
                user: {
                    id: AuthStore.getUser().id
                }
            }
        }
    },

    render(){
        return (
            <div className="content">
                <TextInput label="Name" valueLink={this.linkState('playlist.name')} />
                <br/>
                <TextInput label="Description" valueLink={this.linkState('playlist.description')} />
                <br/>
                <Submit value="Save" onClick={PlaylistsActions.createPlaylist.bind(this, this.state.playlist)}/>
            </div>
        )
    }
});