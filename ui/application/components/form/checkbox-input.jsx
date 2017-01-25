'use strict';

import React from 'react';
import _ from 'lodash';

export default React.createClass({

    propTypes: {
        label: React.PropTypes.string,
        checkedLink: React.PropTypes.shape({
            value: React.PropTypes.bool,
            onChange: React.PropTypes.func.isRequired
        }).isRequired
    },

    getDefaultProps() {
        return {
            label: ''
        }
    },

    render() {
        return (
            <div className="input-group">
                <span className="input-group-addon">{this.props.label}</span>
                <div className="form-control">
                    <input
                        defaultValue={this.props.checkedLink.value}
                        onChange={this.props.checkedLink.onChange}
                        type="checkbox"
                        />
                </div>
            </div>
        );
    }
});