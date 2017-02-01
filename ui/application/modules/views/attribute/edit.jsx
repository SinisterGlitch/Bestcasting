'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin';
import AttributeStore from 'modules/stores/attribute';
import AttributeActions from 'modules/actions/attribute';

import EntityEditor from 'components/core/entity_editor';

export default React.createClass({

    mixins: [
        StateMixin,
        Reflux.listenTo(AttributeStore, 'onLoadAttribute')
    ],

    componentDidMount() {
        AttributeActions.loadAttribute(this.props.params.id)
    },

    getInitialState() {
        return {
            attribute: {}
        };
    },

    onLoadAttribute() {
        this.setState({
            attribute: AttributeStore.getAttribute(this.props.params.id)
        });
    },

    onSubmit() {
        AttributeActions.updateAttribute(this.props.params.id, this.state.attribute);
    },

    render(){
        return (
            <div key="content">
                <EntityEditor />
            </div>
        );
    }
});