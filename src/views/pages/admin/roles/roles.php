<?php

use core\helpers\CoreHelpers;

$this->title = "Levels & Permissions";

?>

<?= partials('AdminCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h2 class="">Role Permissions Manager</h2>
                    <div>
                        <a href="/admin/roles/create/new" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i> New Level</a>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role</th>
                            <th scope="col">Document Type</th>
                            <th scope="col">Permissions</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $key => $role) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td class="text-capitalize"><?= $role->role ?></td>
                                <td><?= $role->doctype ?></td>
                                <td class="d-flex justify-content-between align-items-center">
                                    <p><?= $role->read ? 'Read' : '' ?></p>
                                    <p><?= $role->write ? 'Write' : '' ?></p>
                                    <p><?= $role->delete ? 'Delete' : '' ?></p>
                                </td>
                                <td class="text-end">
                                    <a href="/admin/roles/create/<?= $role->id ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>