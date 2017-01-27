'use strict';

import _ from 'lodash';

export default {

    /**
     * @param propertyPath
     * @returns {{value: *, requestChange: (function(*=): *)}}
     */
    linkState(propertyPath) {
        return {
            value: _.get(this.state, propertyPath, ''),
            requestChange: value => this.setState(_.set(_.clone(this.state), propertyPath, value))
        };
    },

    /**
     * @param propertyPath
     * @param value
     */
    updateProperty(propertyPath, value) {
        this.setState(_.set(_.clone(this.state), propertyPath, value));
    }
};