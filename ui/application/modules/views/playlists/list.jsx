'use strict';

import React from 'react';
import { Link } from 'react-router';
import Reflux from 'reflux';
import _ from 'lodash';

import PlaylistsStore from 'modules/stores/playlists';
import PlaylistsActions from 'modules/actions/playlists';

export default React.createClass({

    mixins: [
        Reflux.listenTo(PlaylistsStore, 'onLoadPlaylists')
    ],

    componentDidMount() {
        PlaylistsActions.loadPlaylists()
    },

    getInitialState() {
        return {
            playlists: PlaylistsStore.getPlaylists()
        }
    },

    onLoadPlaylists() {
        this.setState({
            playlists: PlaylistsStore.getPlaylists()
        });
    },

    render(){
        return (
            <div key="content">
                <table className="table table-hover">
                    <thead>
                    <tr>
                        <th key="1-1">Name</th>
                        <th key="1-2"></th>
                        <th key="1-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                        {_.map(this.state.playlists, this.renderRow)}
                    </tbody>
                </table>
            </div>
        )
    },

    renderRow(playlists) {
        if (_.isUndefined(playlists)) {
            return;
        }

        return (
            <tr key={playlists.id}>
                <td>{playlists.name}</td>
                <td><Link key="detail" to={'/playlists/detail/'+playlists.id}>detail</Link></td>
                <td><Link key="edit" to={'/playlists/edit/'+playlists.id}>edit</Link></td>
            </tr>
        );
    }
});