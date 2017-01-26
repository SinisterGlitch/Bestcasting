'use strict';

import React from 'react';
import AuthStore from 'stores/auth';
import {Navbar, Nav, MenuItem, NavDropdown} from 'react-bootstrap';

import { LinkContainer } from 'react-router-bootstrap'

export default React.createClass({

    menuItems: [
        {label: 'home', route: '/dashboard'},
        {label: 'stores', route: [
            {label: 'browse', route: '/stores'},
            {label: 'create', route: '/stores/new'}
        ]},
        {label: 'screens', route: [
            {label: 'browse', route: '/screens'},
            {label: 'create', route: '/screens/new'}
        ]},
        {label: 'playlists', route: [
            {label: 'browse', route: '/playlists'},
            {label: 'create', route: '/playlists/new'}
        ]},
        {label: 'slides', route: [
            {label: 'browse', route: '/slides'},
            {label: 'create', route: '/slides/new'}
        ]}
    ],

    loginItems: [
        {label: 'User', route: [
            AuthStore.getToken()
                ? {label: 'logout', route: '/logout'}
                : {label: 'login', route: '/login'},
                  {label: 'register', route: '/register'}
        ]}
    ],


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
            <Navbar collapseOnSelect>
                <Navbar.Header>
                    <Navbar.Brand>
                       Bestcasting
                    </Navbar.Brand>
                    <Navbar.Toggle />
                </Navbar.Header>
                <Navbar.Collapse>
                    <Nav>
                        {this.menuItems.map((item) => this.renderItem(item))}
                    </Nav>
                    <Nav pullRight>
                        {this.loginItems.map((item) => this.renderItem(item))}
                    </Nav>
                </Navbar.Collapse>
            </Navbar>
        );
    }
});