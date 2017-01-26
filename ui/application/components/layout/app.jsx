'use strict';

import React from 'react';

import Notification from 'components/layout/notification';
import Navigation from 'components/layout/navigation';

export default React.createClass({

    render() {
        return (
        <div>
            <Navigation />
            <Notification />
            <div className="container">
                <div className="jumbotron">
                    {this.props.children}
                </div>
            </div>
        </div>
        );
    }
});

