'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

import SlidesStore from 'modules/stores/slides';
import SlidesActions from 'modules/actions/slides';

export default React.createClass({

    mixins: [
        StateMixin,
        Reflux.listenTo(SlidesStore, 'onLoadSlide')
    ],

    componentDidMount() {
        SlidesActions.loadSlide(this.props.params.id)
    },

    getInitialState() {
        return {
            slide: {}
        };
    },

    onLoadSlide() {
        this.setState({
            slide: SlidesStore.getSlide(this.props.params.id)
        });
    },

    onSubmit() {
        SlidesActions.updateSlide(this.props.params.id, this.state.slide);
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
                <TextInput label="Type" valueLink={this.linkState('slide.data_type')} />
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