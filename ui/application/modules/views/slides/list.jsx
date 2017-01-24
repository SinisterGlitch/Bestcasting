'use strict';

import React from 'react';
import { Link } from 'react-router';
import Reflux from 'reflux';
import _ from 'lodash';

import SlidesStore from 'modules/stores/slides';
import SlidesActions from 'modules/actions/slides';

export default React.createClass({

    mixins: [
        Reflux.listenTo(SlidesStore, 'onLoadSlides')
    ],

    componentDidMount() {
        SlidesActions.loadSlides()
    },

    getInitialState() {
        return {
            slides: SlidesStore.getSlides()
        }
    },

    onLoadSlides() {
        this.setState({
            slides: SlidesStore.getSlides()
        });
    },

    render(){
        return (
            <div key="content">
                <table className="table table-hover">
                    <thead>
                    <tr>
                        <th key="1-1">Name</th>
                        <th key="1-2"></th>
                        <th key="1-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                        {_.map(this.state.slides, this.renderRow)}
                    </tbody>
                </table>
            </div>
        )
    },

    renderRow(slide) {
        if (_.isUndefined(slide)) {
            return;
        }

        return (
            <tr key={slide.id}>
                <td>{slide.name}</td>
                <td><Link key="detail" to={'/slides/detail/'+slide.id}>detail</Link></td>
                <td><Link key="edit" to={'/slides/edit/'+slide.id}>edit</Link></td>
            </tr>
        );
    }
});