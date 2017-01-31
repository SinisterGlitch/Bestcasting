'use strict';

import React from 'react';
import AuthStore from 'stores/auth';
import {Navbar, Nav, MenuItem, NavDropdown} from 'react-bootstrap';
import {LinkContainer} from 'react-router-bootstrap'

export default React.createClass({

    menuItems: [
        {label: 'Dashboard', route: '/dashboard'},
        {label: 'Catalog', route: [
            {label: 'browse', route: '/stores'},
            {label: 'create', route: '/stores/new'}
        ]}
    ],

    getLoginItems() {
        let label = 'User';
        let routes = [
            {label: 'register', route: '/register'},
            {label: 'login', route: '/login'}
        ];

        if (AuthStore.getToken()) {
            label = AuthStore.getUser().firstname.charAt(0).toUpperCase() +
                    AuthStore.getUser().lastname.charAt(0).toUpperCase();

            routes = [
                {label: 'logout', route: '/logout'}
            ];
        }

        return [{
            label: label,
            route: routes
        }];
    },

    renderItem(item) {
        if (typeof item.route != 'object') {
            return (
                <LinkContainer key={item.label} to={{ pathname: item.route}}>
                    <MenuItem activeHref="active">{item.label}</MenuItem>
                </LinkContainer>
            );
        }

        return (
            <NavDropdown eventKey={3} key={item.label} title={item.label} id="basic-nav-dropdown">
                {item.route.map((item) => this.renderItem(item))}
            </NavDropdown>
        );
    },

    render() {
        return (
            <Navbar className="main-nav" staticTop inverse collapseOnSelect>
                <Navbar.Header>
                    <Navbar.Brand>
                       UTOMO
                    </Navbar.Brand>
                    <Navbar.Toggle />
                </Navbar.Header>
                <Navbar.Collapse>
                    <Nav>
                        {this.menuItems.map((item) => this.renderItem(item))}
                    </Nav>
                    <Nav pullRight>
                        {this.getLoginItems().map((item) => this.renderItem(item))}
                    </Nav>
                </Navbar.Collapse>
            </Navbar>
        );
    }
});