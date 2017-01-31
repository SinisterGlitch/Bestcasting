'use strict';

import React from 'react';
import Reflux from'reflux';
import _ from 'lodash';

import AttributeActions from 'modules/actions/attribute';

export default Reflux.createStore({
    listenables: AttributeActions,

    /**
     * @var {Array}
     */
    _attributes: [],

    /**
     * @param {Array} attributes
     */
    loadAttributesCompleted(attributes) {
        _.forEach(attributes, attribute => this._attributes[attribute.id] = attribute);
        this.trigger();
    },

    /**
     * @param {Object} attribute
     */
    loadAttributeCompleted(attribute) {
        this._attributes[attribute.id] = attribute;
        this.trigger();
    },

    /**
     * @return {Array}
     */
    getAttributes() {
        return this._attributes;
    },

    /**
     * @return {Object}
     */
    getAttribute(id) {
        return _.has(this._attributes, id) ? this._attributes[id] : '';
    }
});