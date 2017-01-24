'use strict';

import React from 'react';
import Reflux from 'reflux';
import _ from 'lodash';

import ScreensScreen from 'modules/screens/screens';
import ScreensActions from 'modules/actions/screens';

export default React.createClass({

    mixins: [
        Reflux.listenTo(ScreensScreen, 'onLoadScreen')
    ],

    componentDidMount() {
        if (_.isEmpty(ScreensScreen.getScreen(this.props.params.id))) {
            ScreensActions.loadScreen(this.props.params.id);
        }
    },

    getInitialState() {
        return {
            screen: ScreensScreen.getScreen(this.props.params.id)
        }
    },

    onLoadScreen() {
        this.setState({
            screen: ScreensScreen.getScreen(this.props.params.id)
        });
    },

    render(){
        return (
            <div key="content">
                {!_.isEmpty(this.state.screen) ? this.state.screen.id+' | '+this.state.screen.name : ''}
            </div>
        )
    }
});