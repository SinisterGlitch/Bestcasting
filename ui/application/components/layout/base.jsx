'use strict';

import React from 'react';
import {Grid, Row} from 'react-bootstrap';
import Notification from 'components/layout/notification';

export default React.createClass({

    render() {
        return (
            <Grid>
                <Notification />
                <Row className="show-grid">
                    {this.props.children}
                </Row>
            </Grid>
        );
    }
});

