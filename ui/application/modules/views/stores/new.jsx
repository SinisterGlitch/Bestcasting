'use strict';

import React from 'react';
import Reflux from 'reflux';

import FormMixin from 'mixins/form-mixin';
import Checkbox from 'components/form/checkbox-input';
import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

import AuthStore from 'stores/auth';
import StoresActions from 'modules/actions/stores';

export default React.createClass({

    mixins: [
        Reflux.listenTo(StoresActions.saveStores.completed, 'onSave'),
        FormMixin
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
                <Submit value="Save" onClick={StoresActions.saveStores.bind(this, this.state.store)}/>
            </div>
        )
    }
});