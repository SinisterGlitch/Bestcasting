'use strict';

import React from 'react';
import {Grid, Row} from 'react-bootstrap';

export default React.createClass({

    render() {
        return (
            <Grid>
                <Row className="show-grid">
                    {this.props.children}
                </Row>
            </Grid>
        );
    }
});

