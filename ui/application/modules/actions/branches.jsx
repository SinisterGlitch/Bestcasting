'use strict';

import React from 'react';
import Reflux from 'reflux';
import Request from 'services/request';

let BranchesActions = Reflux.createActions({
    saveBranches:   {children: ['completed','failed']},
    updateBranches: {children: ['completed','failed']},
    deleteBranches: {children: ['completed','failed']},
    loadBranches:   {children: ['completed','failed']},
    loadBranch:     {children: ['completed','failed']}
});

BranchesActions.saveBranches.listen(
    data => Request.post('branches', data, BranchesActions.saveBranches)
);

BranchesActions.updateBranches.listen(
    data => Request.put('branches', data, BranchesActions.updateBranches)
);

BranchesActions.deleteBranches.listen(
    data => Request.delete('branches', data, BranchesActions.deleteBranches)
);

BranchesActions.loadBranch.listen(
    id => Request.get('branches/' + id, BranchesActions.loadBranch)
);

BranchesActions.loadBranches.listen(()
    => Request.get('branches', BranchesActions.loadBranches)
);

export default BranchesActions;