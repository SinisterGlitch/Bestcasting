'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
import Checkbox from 'components/form/checkbox-input';
import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

import AuthSlide from 'stores/auth';
import SlidesActions from 'modules/actions/slides';

export default React.createClass({

    mixins: [
        Reflux.listenTo(SlidesActions.createSlide.completed, 'onSave'),
        StateMixin
    ],

    getInitialState() {
        return {
            slide: {
                active: false,
                user: {
                    id: AuthSlide.getUser().id
                }
            }
        }
    },

    render(){
        return (
            <div className="content">
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
                <Submit value="Save" onClick={SlidesActions.createSlide.bind(this, this.state.slide)}/>
            </div>
        )
    }
});