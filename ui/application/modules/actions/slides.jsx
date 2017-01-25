'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let SlidesActions = Reflux.createActions({
    createSlide: {children: ['completed','failed']},
    updateSlide: {children: ['completed','failed']},
    deleteSlide: {children: ['completed','failed']},
    loadSlides:  {children: ['completed','failed']},
    loadSlide:   {children: ['completed','failed']}
});

SlidesActions.loadSlides.listen(() => Request.get('slides/', SlidesActions.loadSlides));
SlidesActions.loadSlide.listen(id => Request.get('slides/' + id, SlidesActions.loadSlide));
SlidesActions.createSlide.listen(data => Request.post('slides/', data, SlidesActions.createSlide));
SlidesActions.updateSlide.listen((id ,data) => Request.put('slides/' + id, data, SlidesActions.updateSlide));
SlidesActions.deleteSlide.listen((id ,data) => Request.delete('slides/' + id, data, SlidesActions.deleteSlide));

export default SlidesActions;