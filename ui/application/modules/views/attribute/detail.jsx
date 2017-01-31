'use strict';

import React from 'react';
import Reflux from 'reflux';
import _ from 'lodash';

import StoresStore from 'modules/stores/attribute';
import StoresActions from 'modules/actions/attribute';

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
            attribute: StoresStore.getStore(this.props.params.id)
        }
    },

    onLoadStore() {
        this.setState({
            attribute: StoresStore.getStore(this.props.params.id)
        });
    },

    render(){
        return (
            <div key="content">
                {!_.isEmpty(this.state.attribute) ? this.state.attribute.id+' | '+this.state.attribute.name : ''}
            </div>
        )
    }
});