'use strict';

import React from 'react';
import { Link } from 'react-router'
import AuthStore from 'stores/auth';

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
                ? {label: 'logout', route: '/dashboard/logout'}
                : {label: 'login', route: '/dashboard/login'},
                  {label: 'register', route: '/dashboard/register'}
        ]}
    ],


    renderItem(item) {
        if (typeof item.route != 'object') {
            return <li key={item.route}><Link activeClassName="active" to={item.route}>{item.label}</Link></li>
        }

        return (
            <li key={item.label} className="dropdown">
                <a href="#" className="dropdown-toggle" data-toggle="dropdown">{item.label}<b className="caret"></b></a>
                <ul className="dropdown-menu">
                    {item.route.map((item) => this.renderItem(item))}
                </ul>
            </li>
        );
    },

    render() {
        if (AuthStore.getToken() == null) return null;

        return (
            <div id="header" className="navbar navbar-default navbar-static-top">
                <div className="navbar-header">
                    <button className="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <i className="icon-reorder"></i>
                    </button>
                    <a className="navbar-brand" href="#">
                        BestCasting
                    </a>
                </div>
                <nav className="collapse navbar-collapse">
                    <ul key="navbar-left" className="nav navbar-nav">
                        {this.menuItems.map((item) => this.renderItem(item))}
                    </ul>
                    <ul key="navbar-right" className="nav navbar-nav pull-right">
                        {this.loginItems.map((item) => this.renderItem(item))}
                    </ul>
                </nav>
            </div>
        );
    }
});