'use strict';

import React from 'react';
import Reflux from 'reflux';

import FormMixin from 'mixins/form-mixin';
import TextInput from 'components/form/text-input';
import Checkbox from 'components/form/checkbox-input';
import Submit from 'components/form/submit-button';

import ScreensStore from 'modules/stores/slides';
import ScreensActions from 'modules/actions/slides';

export default React.createClass({

    mixins: [
        FormMixin,
        Reflux.listenTo(ScreensStore, 'onLoadScreen')
    ],

    componentDidMount() {
        ScreensActions.loadScreen(this.props.params.id)
    },

    getInitialState() {
        return {
            slide: {}
        };
    },

    onLoadScreen() {
        this.setState({
            slide: ScreensStore.getScreen(this.props.params.id)
        });
    },

    onSubmit() {
        ScreensActions.updateScreen(this.props.params.id, this.state.slide);
    },

    render(){
        return (
            <div key="content">
                <TextInput label="Name" valueLink={this.linkState('slide.name')} />
                <br/>
                <TextInput label="Description" valueLink={this.linkState('slide.description')} />
                <br/>
                <TextInput label="Resolution" valueLink={this.linkState('slide.resolution')} />
                <br/>
                <TextInput label="Type" valueLink={this.linkState('slide.type')} />
                <br/>
                <TextInput label="Size" valueLink={this.linkState('slide.size')} />
                <br/>
                <TextInput label="Path" valueLink={this.linkState('slide.path')} />
                <br/>
                <Submit value="Save" onClick={this.onSubmit} />
            </div>
        );
    }
});