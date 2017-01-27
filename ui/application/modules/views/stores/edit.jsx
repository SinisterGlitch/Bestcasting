'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
import TextInput from 'components/form/text-input';
import Checkbox from 'components/form/checkbox-input';
import Submit from 'components/form/submit-button';

import StoresStore from 'modules/stores/stores';
import StoresActions from 'modules/actions/stores';

export default React.createClass({

    mixins: [
        StateMixin,
        Reflux.listenTo(StoresStore, 'onLoadStore')
    ],

    componentDidMount() {
        StoresActions.loadStore(this.props.params.id)
    },

    getInitialState() {
        return {
            store: {}
        };
    },

    onLoadStore() {
        this.setState({
            store: StoresStore.getStore(this.props.params.id)
        });
    },

    onSubmit() {
        StoresActions.updateStore(this.props.params.id, this.state.store);
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