'use strict';

import React from 'react';
import AuthStore from 'stores/auth';

export default React.createClass({

    getInitialState() {
        return {
            user: AuthStore.getUser()
        }
    },

    render(){
        return (
            <div className="content">
                <span>Welcome, {this.state.user.username}</span>
            </div>
        )
    }
});