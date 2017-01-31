'use strict';

import React from 'react';
import Reflux from 'reflux';

import AttributeActions from 'modules/actions/attribute';
import EntitySelector from 'components/core/entity_selector';

export default React.createClass({

    mixins: [
        Reflux.listenTo(AttributeActions.createAttribute.completed, 'onSave')
    ],

    getInitialState() {
        return {
            attribute: {
                active: false
            }
        }
    },

    render(){
        return (
            <div className="content">
                <EntitySelector />
            </div>
        )
    }
});