<?php

use core\forms\Form;
use core\helpers\CoreHelpers;
use src\classes\Extras;

$this->title = "Admin Users";

?>

<?= partials('AdminCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/admin/lecturers/lists" class="btn btn-sm btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
                </div>
                <div class="row">
                    <div class="">
                        <img src="<?= Extras::GetImage('') ?>" class="border border-primary d-block mx-auto rounded-circle" style="width:150px;">
                        <h3 class="text-center text-uppercase text-danger"><?= $lecturer->surname . ' ' . $lecturer->firstname . ' ' . $lecturer->lastname ?></h3>
                    </div>
                    <div class="bg-light p-2">
                        <table class="table table-responsive table-borderless table-hover table-striped">
                            <tr>
                                <th>Faculty</th>
                                <td class="text-capitalize"><?= $lecturer->faculty ?></td>

                                <th>Department</th>
                                <td class="text-capitalize"><?= $lecturer->department ?></td>
                            </tr>
                            <tr>
                                <th>Degree</th>
                                <td class="text-capitalize"><?= $lecturer->degree ?></td>

                                <th>Position</th>
                                <td class="text-capitalize"><?= $lecturer->position ?></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td class="text-capitalize"><?= $lecturer->surname ?></td>

                                <th>Firstname</th>
                                <td class="text-capitalize"><?= $lecturer->firstname ?></td>
                            </tr>
                            <tr>
                                <th>Lastname</th>
                                <td class="text-capitalize"><?= $lecturer->lastname ?></td>

                                <th>Email</th>
                                <td class=""><?= $lecturer->email ?></td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td class="text-capitalize"><?= $lecturer->phone ?></td>

                                <th>Date of Birth</th>
                                <td class="text-capitalize"><?= $lecturer->dob ?></td>
                            </tr>
                        </table>
                        <?php if (empty($extUser)) : ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col">
                                    <a href="/admin/users/create/new?lecturer_no=<?= $lecturer->lecturer_no ?>" class="btn btn-sm btn-primary w-50">Verify</a>
                                </div>
                                <div class="col text-end">
                                    <a href="#" class="btn btn-sm btn-danger w-50">Cancel</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
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