'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let PlaylistsActions = Reflux.createActions({
    createPlaylist:   {children: ['completed','failed']},
    updatePlaylist: {children: ['completed','failed']},
    deletePlaylist: {children: ['completed','failed']},
    loadPlaylists:   {children: ['completed','failed']},
    loadPlaylist:    {children: ['completed','failed']}
});

PlaylistsActions.loadPlaylists.listen(() => Request.get('playlists/', PlaylistsActions.loadPlaylists));
PlaylistsActions.loadPlaylist.listen(id => Request.get('playlists/' + id, PlaylistsActions.loadPlaylist));
PlaylistsActions.createPlaylist.listen(data => Request.post('playlists/', data, PlaylistsActions.createPlaylist));
PlaylistsActions.updatePlaylist.listen((id ,data) => Request.put('playlists/' + id, data, PlaylistsActions.updatePlaylist));
PlaylistsActions.deletePlaylist.listen((id ,data) => Request.delete('playlists/' + id, data, PlaylistsActions.deletePlaylist));

export default PlaylistsActions;