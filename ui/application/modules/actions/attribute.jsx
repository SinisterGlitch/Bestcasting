'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let AttributeActions = Reflux.createActions({
    createAttribute: {children: ['completed','failed']},
    updateAttribute: {children: ['completed','failed']},
    deleteAttribute: {children: ['completed','failed']},
    loadAttributes:  {children: ['completed','failed']},
    loadAttribute:   {children: ['completed','failed']}
});

AttributeActions.loadAttributes.listen(() => Request.get('attribute/', AttributeActions.loadAttributes));
AttributeActions.loadAttribute.listen(id => Request.get('attribute/' + id, AttributeActions.loadAttribute));
AttributeActions.createAttribute.listen(data => Request.post('attribute/', data, AttributeActions.createAttribute));
AttributeActions.updateAttribute.listen((id ,data) => Request.put('attribute/' + id, data, AttributeActions.updateAttribute));
AttributeActions.deleteAttribute.listen((id ,data) => Request.delete('attribute/' + id, data, AttributeActions.deleteAttribute));

export default AttributeActions;