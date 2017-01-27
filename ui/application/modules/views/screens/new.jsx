'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
import Checkbox from 'components/form/checkbox-input';
import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

import AuthScreen from 'stores/auth';
import ScreensActions from 'modules/actions/screens';

export default React.createClass({

    mixins: [
        Reflux.listenTo(ScreensActions.createScreen.completed, 'onSave'),
        StateMixin
    ],

    getInitialState() {
        return {
            screen: {
                active: false,
                user: {
                    id: AuthScreen.getUser().id
                }
            }
        }
    },

    render(){
        return (
            <div className="content">
                <TextInput label="Name" valueLink={this.linkState('screen.name')} />
                <br/>
                <TextInput label="Description" valueLink={this.linkState('screen.description')} />
                <br/>
                <TextInput label="Type" valueLink={this.linkState('screen.type')} />
                <br/>
                <TextInput label="Resolution" valueLink={this.linkState('screen.resolution')} />
                <br/>
                <Submit value="Save" onClick={ScreensActions.createScreen.bind(this, this.state.screen)}/>
            </div>
        )
    }
});