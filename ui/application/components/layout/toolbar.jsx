'use strict';

import React from 'react';
import {Navbar, Row, FormGroup, FormControl, Button, SplitButton, MenuItem, ButtonToolbar} from 'react-bootstrap';

export default React.createClass({

    render() {
        return (
            <Navbar className="toolbar-nav">
                <Navbar.Form pullRight>
                    <FormGroup>
                        <Row className="show-grid">
                            <FormControl type="text" placeholder="search for keywords" />&nbsp;
                            <Button className="hidden-xs"  bsStyle="primary" type="submit">Search</Button>
                        </Row>
                    </FormGroup>
                </Navbar.Form>
                    <Navbar.Form pullLeft>
                        <ButtonToolbar>
                            <SplitButton  title="English (United States)" id="split-button-basic-language">
                                <MenuItem eventKey="1">Netherlands</MenuItem>
                                <MenuItem eventKey="2">Germain</MenuItem>
                                <MenuItem eventKey="3">French</MenuItem>
                                <MenuItem divider />
                                <MenuItem eventKey="4">more ...</MenuItem>
                            </SplitButton>
                        </ButtonToolbar>
                    </Navbar.Form>
            </Navbar>
        );
    }
});