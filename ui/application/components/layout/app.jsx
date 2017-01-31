'use strict';

import React from 'react';
import {Grid, Row} from 'react-bootstrap';

import Toolbar from 'components/layout/toolbar';
import Navigation from 'components/layout/navigation';

export default React.createClass({

    render() {
        return (
        <Grid>
            <Row>
                <Navigation />
                <Toolbar />
            </Row>
            <Row className="content">
                {this.props.children}
            </Row>
        </Grid>
        );
    }
});

