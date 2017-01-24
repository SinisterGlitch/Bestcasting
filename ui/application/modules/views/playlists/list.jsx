'use strict';

import React from 'react';
import { Link } from 'react-router';
import Reflux from 'reflux';
import _ from 'lodash';

import StoresStore from 'modules/stores/stores';
import StoresActions from 'modules/actions/stores';

export default React.createClass({

    mixins: [
        Reflux.listenTo(StoresStore, 'onLoadStores')
    ],

    componentDidMount() {
        StoresActions.loadStores()
    },

    getInitialState() {
        return {
            stores: StoresStore.getStores()
        }
    },

    onLoadStores() {
        this.setState({
            stores: StoresStore.getStores()
        });
    },

    render(){
        return (
            <div key="content">
                <table className="table table-hover">
                    <thead>
                    <tr>
                        <th key="1-1">Name</th>
                        <th key="1-2"></th>
                        <th key="1-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                        {_.map(this.state.stores, this.renderRow)}
                    </tbody>
                </table>
            </div>
        )
    },

    renderRow(store) {
        if (_.isUndefined(store)) {
            return;
        }

        return (
            <tr key={store.id}>
                <td>{store.name}</td>
                <td><Link key="detail" to={'/stores/detail/'+store.id}>detail</Link></td>
                <td><Link key="edit" to={'/stores/edit/'+store.id}>edit</Link></td>
            </tr>
        );
    }
});