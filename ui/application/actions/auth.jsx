'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let UserActions = Reflux.createActions({
    loadUser:   {children: ['completed','failed']},
    postUser:   {children: ['completed','failed']},
});

UserActions.loadUser.listen(
    data => Request.post('app_dev.php/users/login', data, UserActions.loadUser)
);

UserActions.postUser.listen(
    data => Request.post('app_dev.php/users/register', data, UserActions.postUser)
);

export default UserActions;