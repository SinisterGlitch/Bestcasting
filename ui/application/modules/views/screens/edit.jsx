'use strict';

import React from 'react';
import Reflux from 'reflux';

import FormMixin from 'mixins/form-mixin';
import TextInput from 'components/form/text-input';
import Checkbox from 'components/form/checkbox-input';
import Submit from 'components/form/submit-button';

import ScreensScreen from 'modules/screens/screens';
import ScreensActions from 'modules/actions/screens';

export default React.createClass({

    mixins: [
        FormMixin,
        Reflux.listenTo(ScreensScreen, 'onLoadScreen')
    ],

    componentDidMount() {
        ScreensActions.loadScreen(this.props.params.id)
    },

    getInitialState() {
        return {
            screen: {}
        };
    },

    onLoadScreen() {
        this.setState({
            screen: ScreensScreen.getScreen(this.props.params.id)
        });
    },

    onSubmit() {
        ScreensActions.updateScreens(this.state.screen);
    },

    render(){
        return (
            <div key="content">
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
                <Submit value="Save" onClick={this.onSubmit} />
            </div>
        );
    }
});