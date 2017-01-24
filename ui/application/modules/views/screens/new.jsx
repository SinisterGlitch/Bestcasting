'use strict';

import React from 'react';
import Reflux from 'reflux';

import FormMixin from 'mixins/form-mixin';
import Checkbox from 'components/form/checkbox-input';
import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

import AuthScreen from 'screens/auth';
import ScreensScreen from 'modules/screens/screens';
import ScreensActions from 'modules/actions/screens';

export default React.createClass({

    mixins: [
        Reflux.listenTo(ScreensActions.saveScreens.completed, 'onSave'),
        FormMixin
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
                <TextInput label="Street" valueLink={this.linkState('screen.street')} />
                <br/>
                <TextInput label="House number" valueLink={this.linkState('screen.house_number')} />
                <br/>
                <TextInput label="City" valueLink={this.linkState('screen.city')} />
                <br/>
                <TextInput label="Zipcode" valueLink={this.linkState('screen.zip_code')} />
                <br/>
                <Checkbox label="Active" checkedLink={this.linkState('screen.active')} />
                <br/>
                <Submit value="Save" onClick={ScreensActions.saveScreens.bind(this, this.state.screen)}/>
            </div>
        )
    }
});