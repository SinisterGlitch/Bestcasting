'use strict';

import React from 'react';
import ReactRouter from 'react-router';
import Reflux from 'reflux';

import FormMixin from 'mixins/form-mixin'
import AuthActions from 'actions/auth';
import UserStore from 'stores/auth';

import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

export default React.createClass({

    mixins: [
        Reflux.listenTo(AuthActions.postUser.completed, 'onRegister'),
        FormMixin
    ],

    getInitialState() {
        return {
            user: {}
        }
    },

    onLoadUser() {
        this.setState({
            user: UserStore.getUser()
        });
    },

    onRegister() {
        // this.props.router.push({pathname: '/dashboard'});
    },

    render(){
        return (
            <div className="content">
                <TextInput label="Username" valueLink={this.linkState('user.username')} />
                <br/>
                <TextInput label="Password" hideInput={true} valueLink={this.linkState('user.password')}  />
                <br/>
                <TextInput label="Email" valueLink={this.linkState('user.email')} />
                <br/>
                <Submit value="Login" onClick={AuthActions.postUser.bind(this, this.state.user)} />
            </div>
        )
    }
});