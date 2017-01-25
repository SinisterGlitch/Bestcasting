'use strict';

import React from 'react';

export default React.createClass({

    shouldComponentUpdate(nextProps) {
        return nextProps.valueLink.value != undefined;
    },

    propTypes: {
        label: React.PropTypes.string,
        valueLink: React.PropTypes.shape({
            value: React.PropTypes.string,
            onChange: React.PropTypes.func.isRequired
        }).isRequired
    },

    getDefaultProps() {
        return {
            hideInput: false,
            label: ''
        }
    },

    render() {
        return (
            <div className="input-group">
                <span className="input-group-addon">{this.props.label}</span>
                <input
                   className="form-control"
                   value={this.props.valueLink.value}
                   onChange={this.props.valueLink.onChange}
                   type={this.props.hideInput ? 'password' : 'text'}
                />
            </div>
        );
    }
});