<?php

use core\forms\Form;
use core\helpers\CoreHelpers;
use src\classes\Extras;

global $currentLink;
global $quryStr;

$this->title = "Admin Users";

?>

<?= partials('AdminCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="">All Staff Members
                        <?php if ($total > 0) : ?>
                            <span class="badge bg-danger rounded-circle"><?= $total ?></span>
                        <?php endif; ?>
                    </h5>
                    <div>
                        <a href="/admin/users/create/new" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i> New User</a>
                    </div>
                </div>

                <hr class="mt-1">

                <?php if ($users) : ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-Mail</th>
                                <th scope="col">Access Level</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $user) : ?>
                                <tr>
                                    <th scope="row"><?= $key + 1 ?></th>
                                    <td class="text-capitalize"><?= $user->surname . ' ' . $user->firstname . ' ' . $user->lastname ?></td>
                                    <td><?= $user->email ?></td>
                                    <td class="text-capitalize"><?= $user->acl ?></td>
                                    <td class="text-capitalize"><?= $user->status ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Preview"><i class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#previewUser"></i></button>
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteUser('<?= $user->user_id ?>')" data-bs-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <nav aria-label="Pagination">
                        <ul class="d-flex justify-content-evenly align-items-center my-1 pagination">
                            <li class="page-item <?= !$prevPage ? 'disabled' : '' ?>" aria-current="page">
                                <a class="page-link" href="<?= ROOT . $currentLink ?>?<?= $quryStr ?>page=<?= $prevPage ?>">Prev</a>
                            </li>
                            <li class="page-item <?= !$nextPage ? 'disabled' : '' ?>" aria-current="page">
                                <a class="page-link" href="<?= ROOT . $currentLink ?>?<?= $quryStr ?>page=<?= $nextPage ?>">Next</a>
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


<!-- Modals -->

<div class="modal fade" id="previewUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="previewUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLiveLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-auto">
                <div class="row">
                    <div class="">
                        <img src="<?= Extras::GetImage('') ?>" class="border border-primary d-block mx-auto rounded-circle" style="width:150px;">
                        <h3 class="text-center">Celio Natti</h3>
                    </div>
                    <div class="bg-light p-2">
                        <table class="table table-hover table-striped table-bordered">
                            <tr>
                                <th>First Name:</th>
                                <td>Celio</td>
                            </tr>
                            <tr>
                                <th>Last Name:</th>
                                <td>Natti</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>celionatti@gmail.com</td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td>Male</td>
                            </tr>
                            <tr>
                                <th>Rank:</th>
                                <td><?= ucwords(str_replace("_", " ", 'Admin')) ?></td>
                            </tr>
                            <tr>
                                <th>Date Created:</th>
                                <td>22-July-2022</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save User</button>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteUser(id) {
        if (window.confirm("Are you sure you want to delete this user? This cannot be undone!")) {
            window.location.href = `/admin/users/delete/${id}`;
        }
    }
</script>