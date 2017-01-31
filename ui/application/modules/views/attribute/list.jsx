'use strict';

import React from 'react';
import { Link } from 'react-router';
import Reflux from 'reflux';
import _ from 'lodash';

import StoresStore from 'modules/stores/attribute';
import StoresActions from 'modules/actions/attribute';

export default React.createClass({

    mixins: [
        Reflux.listenTo(StoresStore, 'onLoadStores')
    ],

    componentDidMount() {
        StoresActions.loadStores()
    },

    getInitialState() {
        return {
            attributes: StoresStore.getStores()
        }
    },

    onLoadStores() {
        this.setState({
            attributes: StoresStore.getStores()
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
                        {_.map(this.state.attributes, this.renderRow)}
                    </tbody>
                </table>
            </div>
        )
    },

    renderRow(attribute) {
        if (_.isUndefined(attribute)) {
            return;
        }

        return (
            <tr key={attribute.id}>
                <td>{attribute.name}</td>
                <td><Link key="detail" to={'/attribute/detail/'+attribute.id}>detail</Link></td>
                <td><Link key="edit" to={'/attribute/edit/'+attribute.id}>edit</Link></td>
            </tr>
        );
    }
});