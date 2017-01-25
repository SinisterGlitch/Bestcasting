'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let StoresActions = Reflux.createActions({
    createStore: {children: ['completed','failed']},
    updateStore: {children: ['completed','failed']},
    deleteStore: {children: ['completed','failed']},
    loadStores:  {children: ['completed','failed']},
    loadStore:   {children: ['completed','failed']}
});

StoresActions.loadStores.listen(() => Request.get('stores/', StoresActions.loadStores));
StoresActions.loadStore.listen(id => Request.get('stores/' + id, StoresActions.loadStore));
StoresActions.createStore.listen(data => Request.post('stores/', data, StoresActions.createStore));
StoresActions.updateStore.listen((id ,data) => Request.put('stores/' + id, data, StoresActions.updateStore));
StoresActions.deleteStore.listen((id ,data) => Request.delete('stores/' + id, data, StoresActions.deleteStore));

export default StoresActions;