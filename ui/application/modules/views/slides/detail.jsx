'use strict';

import React from 'react';
import Reflux from 'reflux';
import _ from 'lodash';

import SlidesStore from 'modules/stores/slides';
import SlidesActions from 'modules/actions/slides';

export default React.createClass({

    mixins: [
        Reflux.listenTo(SlidesStore, 'onLoadSlide')
    ],

    componentDidMount() {
        if (_.isEmpty(SlidesStore.getSlide(this.props.params.id))) {
            SlidesActions.loadSlide(this.props.params.id);
        }
    },

    getInitialState() {
        return {
            slide: SlidesStore.getSlide(this.props.params.id)
        }
    },

    onLoadSlide() {
        this.setState({
            slide: SlidesStore.getSlide(this.props.params.id)
        });
    },

    render(){
        return (
            <div key="content">
                {!_.isEmpty(this.state.slide) ? this.state.slide.id+' | '+this.state.slide.name : ''}
            </div>
        )
    }
});