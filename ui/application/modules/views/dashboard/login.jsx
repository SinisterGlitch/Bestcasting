'use strict';

import React from 'react';
import Reflux from 'reflux';

import FormMixin from 'mixins/form-mixin'
import AuthActions from 'actions/auth';

import { LinkContainer } from 'react-router-bootstrap'
import {Form, FormGroup, Col, Checkbox, Button, FormControl, PageHeader} from 'react-bootstrap';

export default React.createClass({

    mixins: [
        Reflux.listenTo(AuthActions.loadUser, 'onLogin'),
        FormMixin
    ],

    getInitialState() {
        return {
            user: {}
        }
    },

    onLogin() {
        this.props.router.push({pathname: '/dashboard'});
    },

    render(){
        return (
            <div>
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
                            <Button bsStyle="primary" onClick={AuthActions.loadUser.bind(this, this.state.user)} type="submit" >Sign in</Button>
                            &nbsp;
                            <LinkContainer to={{pathname: '/register'}}>
                                <Button>Register now</Button>
                            </LinkContainer>
                        </Col>
                    </FormGroup>
                </Form>
            </div>
        )
    }
});