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

ScreensActions.loadScreens.listen(() => Request.get('stores/', ScreensActions.loadScreens));
ScreensActions.loadScreen.listen(id => Request.get('stores/' + id, ScreensActions.loadScreen));
ScreensActions.saveScreens.listen(data => Request.post('stores/', data, ScreensActions.saveScreens));
ScreensActions.updateScreens.listen(data => Request.put('stores/', data, ScreensActions.updateScreens));
ScreensActions.deleteScreens.listen(data => Request.delete('stores/', data, ScreensActions.deleteScreens));

export default ScreensActions;