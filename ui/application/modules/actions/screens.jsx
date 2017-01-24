'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let ScreensActions = Reflux.createActions({
    createScreen:   {children: ['completed','failed']},
    updateScreen: {children: ['completed','failed']},
    deleteScreen: {children: ['completed','failed']},
    loadScreens:   {children: ['completed','failed']},
    loadScreen:    {children: ['completed','failed']}
});

ScreensActions.loadScreens.listen(() => Request.get('screens/', ScreensActions.loadScreens));
ScreensActions.loadScreen.listen(id => Request.get('screens/' + id, ScreensActions.loadScreen));
ScreensActions.createScreen.listen(data => Request.post('screens/', data, ScreensActions.createScreen));
ScreensActions.updateScreen.listen((id ,data) => Request.put('screens/' + id, data, ScreensActions.updateScreen));
ScreensActions.deleteScreen.listen((id ,data) => Request.delete('screens/' + id, data, ScreensActions.deleteScreen));

export default ScreensActions;