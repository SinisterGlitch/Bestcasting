'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
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

            </div>
        );
    }
});