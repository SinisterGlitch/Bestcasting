'use strict';

import React from 'react';
import {Grid, Row, Jumbotron, PageHeader} from 'react-bootstrap';

import Notification from 'components/layout/notification';
import Navigation from 'components/layout/navigation';

export default React.createClass({

    render() {
        return (
        <Grid>
            <Row className="show-grid">
                <PageHeader>Bestcasting <small>a narrowcasting framework</small></PageHeader>
                <Navigation />
                <Notification />
                <Jumbotron>
                    {this.props.children}
                </Jumbotron>
            </Row>
        </Grid>
        );
    }
});

