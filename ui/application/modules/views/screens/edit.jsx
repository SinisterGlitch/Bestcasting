'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

import ScreensStore from 'modules/stores/screens';
import ScreensActions from 'modules/actions/screens';

export default React.createClass({

    mixins: [
        StateMixin,
        Reflux.listenTo(ScreensStore, 'onLoadScreen')
    ],

    componentDidMount() {
        ScreensActions.loadScreen(this.props.params.id)
    },

    getInitialState() {
        return {
            screen: {}
        };
    },

    onLoadScreen() {
        this.setState({
            screen: ScreensStore.getScreen(this.props.params.id)
        });
    },

    onSubmit() {
        ScreensActions.updateScreen(this.props.params.id, this.state.screen);
    },

    render(){
        return (
            <div key="content">
                <TextInput label="Name" valueLink={this.linkState('screen.name')} />
                <br/>
                <TextInput label="Description" valueLink={this.linkState('screen.description')} />
                <br/>
                <TextInput label="Type" valueLink={this.linkState('screen.type')} />
                <br/>
                <TextInput label="Resolution" valueLink={this.linkState('screen.resolution')} />
                <br/>
                <Submit value="Save" onClick={this.onSubmit} />
            </div>
        );
    }
});