<?php

$this->title = "Departments";

?>

<?= partials('AdminCrumbs'); ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="">All Departments</h2>
                    <div>
                        <a href="/admin/department/create/new" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i> New Department</a>
                    </div>
                </div>

                <hr class="mt-1">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Department</th>
                            <th scope="col">Faculty</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($departments as $key => $department) : ?>
                            <tr>
                                <th><?= $key + 1 ?></th>
                                <td class="text-capitalize"><?= $department->department ?></td>
                                <td class="text-capitalize"><?= $department->faculty ?></td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
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