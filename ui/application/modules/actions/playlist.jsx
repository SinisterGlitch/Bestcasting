'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let PlaylistsActions = Reflux.createActions({
    savePlaylists:   {children: ['completed','failed']},
    updatePlaylists: {children: ['completed','failed']},
    deletePlaylists: {children: ['completed','failed']},
    loadPlaylists:   {children: ['completed','failed']},
    loadPlaylist:    {children: ['completed','failed']}
});

PlaylistsActions.loadPlaylists.listen(() => Request.get('playlists/', PlaylistsActions.loadPlaylists));
PlaylistsActions.loadPlaylist.listen(id => Request.get('playlists/' + id, PlaylistsActions.loadPlaylist));
PlaylistsActions.savePlaylists.listen(data => Request.post('playlists/', data, PlaylistsActions.savePlaylists));
PlaylistsActions.updatePlaylists.listen(data => Request.put('playlists/', data, PlaylistsActions.updatePlaylists));
PlaylistsActions.deletePlaylists.listen(data => Request.delete('playlists/', data, PlaylistsActions.deletePlaylists));

export default PlaylistsActions;