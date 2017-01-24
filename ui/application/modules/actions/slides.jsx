'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let SlidesActions = Reflux.createActions({
    saveSlides:   {children: ['completed','failed']},
    updateSlides: {children: ['completed','failed']},
    deleteSlides: {children: ['completed','failed']},
    loadSlides:   {children: ['completed','failed']},
    loadSlide:    {children: ['completed','failed']}
});

SlidesActions.loadSlides.listen(() => Request.get('slides/', SlidesActions.loadSlides));
SlidesActions.loadSlide.listen(id => Request.get('slides/' + id, SlidesActions.loadSlide));
SlidesActions.saveSlides.listen(data => Request.post('slides/', data, SlidesActions.saveSlides));
SlidesActions.updateSlides.listen(data => Request.put('slides/', data, SlidesActions.updateSlides));
SlidesActions.deleteSlides.listen(data => Request.delete('slides/', data, SlidesActions.deleteSlides));

export default SlidesActions;