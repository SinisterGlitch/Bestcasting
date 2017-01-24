'use strict';

import React from 'react';
import Reflux from 'reflux';

import FormMixin from 'mixins/form-mixin';
import Checkbox from 'components/form/checkbox-input';
import TextInput from 'components/form/text-input';
import Submit from 'components/form/submit-button';

import AuthSlide from 'stores/auth';
import SlidesActions from 'modules/actions/slides';

export default React.createClass({

    mixins: [
        Reflux.listenTo(SlidesActions.saveSlides.completed, 'onSave'),
        FormMixin
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
                <Submit value="Save" onClick={SlidesActions.saveSlides.bind(this, this.state.slide)}/>
            </div>
        )
    }
});