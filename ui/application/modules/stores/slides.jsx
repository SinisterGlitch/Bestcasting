'use strict';

import React from 'react';
import Reflux from'reflux';
import _ from 'lodash';

import SlidesActions from 'modules/actions/slides';

export default Reflux.createStore({
    listenables: SlidesActions,

    /**
     * @var {Array}
     */
    _slides: [],

    /**
     * @param {Array} slides
     */
    loadSlidesCompleted(slides) {
        _.forEach(slides, slide => this._slides[slide.id] = slide);
        this.trigger();
    },

    /**
     * @param {Object} slide
     */
    loadSlideCompleted(slide) {
        this._slides[slide.id] = slide;
        this.trigger();
    },

    /**
     * @return {Array}
     */
    getSlides() {
        return this._slides;
    },

    /**
     * @return {Object}
     */
    getSlide(id) {
        return _.has(this._slides, id) ? this._slides[id] : '';
    }
});