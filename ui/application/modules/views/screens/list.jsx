'use strict';

import React from 'react';
import { Link } from 'react-router';
import Reflux from 'reflux';
import _ from 'lodash';

import ScreensScreen from 'modules/screens/screens';
import ScreensActions from 'modules/actions/screens';

export default React.createClass({

    mixins: [
        Reflux.listenTo(ScreensScreen, 'onLoadScreens')
    ],

    componentDidMount() {
        ScreensActions.loadScreens()
    },

    getInitialState() {
        return {
            screens: ScreensScreen.getScreens()
        }
    },

    onLoadScreens() {
        this.setState({
            screens: ScreensScreen.getScreens()
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