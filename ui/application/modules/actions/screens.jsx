'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let ScreensActions = Reflux.createActions({
    saveScreens:   {children: ['completed','failed']},
    updateScreens: {children: ['completed','failed']},
    deleteScreens: {children: ['completed','failed']},
    loadScreens:   {children: ['completed','failed']},
    loadScreen:    {children: ['completed','failed']}
});

ScreensActions.loadScreens.listen(() => Request.get('screens/', ScreensActions.loadScreens));
ScreensActions.loadScreen.listen(id => Request.get('screens/' + id, ScreensActions.loadScreen));
ScreensActions.saveScreens.listen(data => Request.post('screens/', data, ScreensActions.saveScreens));
ScreensActions.updateScreens.listen(data => Request.put('screens/', data, ScreensActions.updateScreens));
ScreensActions.deleteScreens.listen(data => Request.delete('screens/', data, ScreensActions.deleteScreens));

export default ScreensActions;