'use strict';

import React from 'react';
import Reflux from 'reflux';

import FormMixin from 'mixins/form-mixin';
import TextInput from 'components/form/text-input';
import Checkbox from 'components/form/checkbox-input';
import Submit from 'components/form/submit-button';

import ScreensStore from 'modules/stores/stores';
import ScreensActions from 'modules/actions/stores';

export default React.createClass({

    mixins: [
        FormMixin,
        Reflux.listenTo(ScreensStore, 'onLoadScreen')
    ],

    componentDidMount() {
        ScreensActions.loadScreen(this.props.params.id)
    },

    getInitialState() {
        return {
            store: {}
        };
    },

    onLoadScreen() {
        this.setState({
            store: ScreensStore.getScreen(this.props.params.id)
        });
    },

    onSubmit() {
        ScreensActions.updateScreens(this.state.store);
    },

    render(){
        return (
            <div key="content">
                <TextInput label="Name" valueLink={this.linkState('store.name')} />
                <br/>
                <TextInput label="Description" valueLink={this.linkState('store.description')} />
                <br/>
                <TextInput label="Street" valueLink={this.linkState('store.street')} />
                <br/>
                <TextInput label="House number" valueLink={this.linkState('store.house_number')} />
                <br/>
                <TextInput label="City" valueLink={this.linkState('store.city')} />
                <br/>
                <TextInput label="Zipcode" valueLink={this.linkState('store.zip_code')} />
                <br/>
                <Checkbox label="Active" checkedLink={this.linkState('store.active')} />
                <br/>
                <Submit value="Save" onClick={this.onSubmit} />
            </div>
        );
    }
});