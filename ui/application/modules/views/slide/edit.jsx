'use strict';

import React from 'react';
import Reflux from 'reflux';

import FormMixin from 'mixins/form-mixin';
import TextInput from 'components/form/text-input';
import Checkbox from 'components/form/checkbox-input';
import Submit from 'components/form/submit-button';

import ScreensScreen from 'modules/slides/slides';
import ScreensActions from 'modules/actions/slides';

export default React.createClass({

    mixins: [
        FormMixin,
        Reflux.listenTo(ScreensScreen, 'onLoadScreen')
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
            slide: ScreensScreen.getScreen(this.props.params.id)
        });
    },

    onSubmit() {
        ScreensActions.updateScreens(this.state.slide);
    },

    render(){
        return (
            <div key="content">
                <TextInput label="Name" valueLink={this.linkState('slide.name')} />
                <br/>
                <TextInput label="Description" valueLink={this.linkState('slide.description')} />
                <br/>
                <TextInput label="Street" valueLink={this.linkState('slide.street')} />
                <br/>
                <TextInput label="House number" valueLink={this.linkState('slide.house_number')} />
                <br/>
                <TextInput label="City" valueLink={this.linkState('slide.city')} />
                <br/>
                <TextInput label="Zipcode" valueLink={this.linkState('slide.zip_code')} />
                <br/>
                <Checkbox label="Active" checkedLink={this.linkState('slide.active')} />
                <br/>
                <Submit value="Save" onClick={this.onSubmit} />
            </div>
        );
    }
});