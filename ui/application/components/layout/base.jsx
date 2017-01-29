'use strict';

import React from 'react';
import {Grid, Row, Col} from 'react-bootstrap';
import Notification from 'components/layout/notification';

export default React.createClass({

    render() {
        return (
            <Grid>

                <Row>
                    <Notification />
                    {this.props.children}
                </Row>
            </Grid>
        );
    }
});

