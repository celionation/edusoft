<?php

use core\helpers\CoreHelpers;

global $currentLink;

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
                <?php if ($roles) : ?>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Role</th>
                                <th scope="col">Details</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roles as $key => $role) : ?>
                                <tr>
                                    <th scope="row"><?= $key + 1 ?></th>
                                    <td class="text-capitalize"><?= $role->role ?></td>
                                    <td><?= $role->doctype ?></td>

                                    <td class="text-end">
                                        <a href="/admin/roles/create/<?= $role->role_id ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteRole('<?= $role->role_id ?>')" data-bs-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <nav aria-label="Pagination">
                        <ul class="d-flex justify-content-evenly align-items-center my-1 pagination">
                            <li class="page-item <?= !$prevPage ? 'disabled' : '' ?>" aria-current="page">
                                <a class="page-link" href="<?= ROOT . $currentLink ?>?page=<?= $prevPage ?>">Prev</a>
                            </li>
                            <li class="page-item <?= !$nextPage ? 'disabled' : '' ?>" aria-current="page">
                                <a class="page-link" href="<?= ROOT . $currentLink ?>?page=<?= $nextPage ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- //Pagination -->
                <?php else : ?>
                    <h6 class="text-center text-muted">No Data yet!.</h6>
                    <a href="<?= ROOT . $currentLink ?>?page=1" class="btn btn-sm btn-primary text-center w-100"><i class="fas fa-chevron-left"></i> Back</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteRole(id) {
        if (window.confirm("Are you sure you want to delete this role? This cannot be undone!")) {
            window.location.href = `/admin/roles/delete/${id}`;
        }
    }
</script>