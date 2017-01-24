'use strict';

import React from 'react';
import Reflux from 'reflux';
import _ from 'lodash';

import StoresStore from 'modules/stores/stores';
import StoresActions from 'modules/actions/stores';

export default React.createClass({

    mixins: [
        Reflux.listenTo(StoresStore, 'onLoadStore')
    ],

    componentDidMount() {
        if (_.isEmpty(StoresStore.getStore(this.props.params.id))) {
            StoresActions.loadStore(this.props.params.id);
        }
    },

    getInitialState() {
        return {
            store: StoresStore.getStore(this.props.params.id)
        }
    },

    onLoadStore() {
        this.setState({
            store: StoresStore.getStore(this.props.params.id)
        });
    },

    render(){
        return (
            <div key="content">
                {!_.isEmpty(this.state.store) ? this.state.store.id+' | '+this.state.store.name : ''}
            </div>
        )
    }
});