'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let StoresActions = Reflux.createActions({
    saveStores:   {children: ['completed','failed']},
    updateStores: {children: ['completed','failed']},
    deleteStores: {children: ['completed','failed']},
    loadStores:   {children: ['completed','failed']},
    loadStore:    {children: ['completed','failed']}
});

StoresActions.loadStores.listen(() => Request.get('stores/', StoresActions.loadStores));
StoresActions.loadStore.listen(id => Request.get('stores/' + id, StoresActions.loadStore));
StoresActions.saveStores.listen(data => Request.post('stores/', data, StoresActions.saveStores));
StoresActions.updateStores.listen(data => Request.put('stores/', data, StoresActions.updateStores));
StoresActions.deleteStores.listen(data => Request.delete('stores/', data, StoresActions.deleteStores));

export default StoresActions;