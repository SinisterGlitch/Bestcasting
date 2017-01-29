'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
import AuthStore from 'stores/auth';
import StoresActions from 'modules/actions/stores';

export default React.createClass({

    mixins: [
        Reflux.listenTo(StoresActions.createStore.completed, 'onSave'),
        StateMixin
    ],

    getInitialState() {
        return {
            store: {
                active: false,
                user: {
                    id: AuthStore.getUser().id
                }
            }
        }
    },

    render(){
        return (
            <div className="content">
            </div>
        )
    }
});