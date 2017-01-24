'use strict';

import React from 'react';
import { Link } from 'react-router';
import Reflux from 'reflux';
import _ from 'lodash';

import ScreensStore from 'modules/stores/screens';
import ScreensActions from 'modules/actions/screens';

export default React.createClass({

    mixins: [
        Reflux.listenTo(ScreensStore, 'onLoadScreens')
    ],

    componentDidMount() {
        ScreensActions.loadScreens()
    },

    getInitialState() {
        return {
            screens: ScreensStore.getScreens()
        }
    },

    onLoadScreens() {
        this.setState({
            screens: ScreensStore.getScreens()
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
                        {_.map(this.state.screens, this.renderRow)}
                    </tbody>
                </table>
            </div>
        )
    },

    renderRow(screen) {
        if (_.isUndefined(screen)) {
            return;
        }

        return (
            <tr key={screen.id}>
                <td>{screen.name}</td>
                <td><Link key="detail" to={'/screens/detail/'+screen.id}>detail</Link></td>
                <td><Link key="edit" to={'/screens/edit/'+screen.id}>edit</Link></td>
            </tr>
        );
    }
});