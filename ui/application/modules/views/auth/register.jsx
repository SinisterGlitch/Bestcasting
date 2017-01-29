'use strict';

import React from 'react';
import Reflux from 'reflux';

import StateMixin from 'mixins/state-mixin'
import AuthActions from 'actions/auth';

import {LinkContainer} from 'react-router-bootstrap';
import {Form, FormGroup, Col, Row, Button, FormControl, PageHeader} from 'react-bootstrap';

export default React.createClass({

    mixins: [
        Reflux.listenTo(AuthActions.postUser, 'onSubmit'),
        Reflux.listenTo(AuthActions.postUser.completed, 'onRegisterCompleted'),
        Reflux.listenTo(AuthActions.postUser.failed, 'onRegisterFailed'),
        StateMixin
    ],

    getInitialState() {
        return {
            user: {}
        }
    },

    onLoadUser() {
        this.setState({
            user: {},
            loading: false
        });
    },

    onRegisterCompleted() {
        this.props.router.push({pathname: '/login'});
    },

    onRegisterFailed() {
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
                    <PageHeader>Account <small>Register an account</small></PageHeader>
                    <Form horizontal>
                        <FormGroup controlId="formHorizontalUsername">
                            <Col sm={2}>Username</Col>
                            <Col sm={10}>
                                <FormControl placeholder="Username" valueLink={this.linkState('user.username')}/>
                            </Col>
                        </FormGroup>
                        <FormGroup controlId="formHorizontalEmail">
                            <Col sm={2}>Email</Col>
                            <Col sm={10}>
                                <FormControl type="email" placeholder="email" valueLink={this.linkState('user.email')}/>
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
                                <Button
                                    type="button"
                                    bsStyle="primary"
                                    disabled={this.state.loading}
                                    onClick={AuthActions.postUser.bind(this, this.state.user)}>
                                    {this.state.loading ? 'Loading...' : 'Register'}
                                </Button>
                                &nbsp;
                                <LinkContainer to={{pathname: '/login'}}>
                                    <Button>Already have an account?</Button>
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