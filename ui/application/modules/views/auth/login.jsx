'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin'
import AuthActions from 'actions/auth';

import { LinkContainer } from 'react-router-bootstrap'
import {Form, FormGroup, Col, Checkbox, Button, FormControl, PageHeader, Row} from 'react-bootstrap';

export default React.createClass({

    mixins: [
        Reflux.listenTo(AuthActions.loadUser, 'onSubmit'),
        Reflux.listenTo(AuthActions.loadUser.completed, 'onLoginCompleted'),
        Reflux.listenTo(AuthActions.loadUser.failed, 'onLoginFailed'),
        StateMixin
    ],

    getInitialState() {
        return {
            user: {},
            loading: false
        }
    },

    onLoginCompleted() {
        this.props.router.push({pathname: '/dashboard'});
    },

    onLoginFailed() {
        this.updateProperty('loading', false);
    },

    onSubmit() {
        this.updateProperty('loading', true);
    },

    render(){
        return (
            <Row className="show-grid">
                <Col xsHidden md={3}/>
                <Col xs={5} md={5}>
                    <PageHeader>Account <small>Sign in to proceed</small></PageHeader>
                    <Form horizontal>
                        <FormGroup controlId="formHorizontalEmail">
                            <Col sm={2}>Username</Col>
                            <Col sm={10}>
                                <FormControl placeholder="Username" valueLink={this.linkState('user.username')}/>
                            </Col>
                        </FormGroup>
                        <FormGroup controlId="formHorizontalPassword">
                            <Col sm={2}>Password</Col>
                            <Col sm={10}>
                                <FormControl type="password" placeholder="Password" valueLink={this.linkState('user.password')}/>
                            </Col>
                        </FormGroup>
                        <FormGroup>
                            <Col smOffset={2} sm={10}>
                                <Checkbox>Remember me</Checkbox>
                            </Col>
                        </FormGroup>
                        <FormGroup>
                            <Col smOffset={2} sm={10}>
                                <Button
                                    type="button"
                                    bsStyle="primary"
                                    disabled={this.state.loading}
                                    onClick={AuthActions.loadUser.bind(this, this.state.user)}>
                                    {this.state.loading ? 'Loading...' : 'Submit'}
                                </Button>
                                &nbsp;
                                <LinkContainer to={{pathname: '/register'}}>
                                    <Button>Register now</Button>
                                </LinkContainer>
                            </Col>
                        </FormGroup>
                    </Form>
                </Col>
                <Col xsHidden md={2} />
            </Row>
        )
    }
});