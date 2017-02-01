'use strict';

import React from 'react';
import { Link } from 'react-router';
import Reflux from 'reflux';
import _ from 'lodash';

import AttributeStore from 'modules/stores/attribute';
import AttributeActions from 'modules/actions/attribute';

export default React.createClass({

    mixins: [
        Reflux.listenTo(AttributeStore, 'onLoadStores')
    ],

    componentDidMount() {
        AttributeActions.loadAttributes()
    },

    getInitialState() {
        return {
            attributes: AttributeStore.getAttributes()
        }
    },

    onLoadStores() {
        this.setState({
            attributes: AttributeStore.getAttributes()
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