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
                    <a href="/admin/students" class="btn btn-sm btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
                </div>
                <div class="row">
                    <div class="">
                        <img src="<?= Extras::GetImage('') ?>" class="border border-primary d-block mx-auto rounded-circle" style="width:150px;">
                        <h3 class="text-center text-uppercase text-danger"><?= $student->surname . ' ' . $student->firstname . ' ' . $student->lastname ?></h3>
                    </div>
                    <div class="bg-light p-2">
                        <table class="table table-responsive table-borderless table-hover table-striped">
                            <tr>
                                <th>Faculty</th>
                                <td class="text-capitalize"><?= $student->faculty ?></td>

                                <th>Department</th>
                                <td class="text-capitalize"><?= $student->department ?></td>
                            </tr>
                            <tr>
                                <th>Matriculation No:</th>
                                <td class=""><?= $student->matriculation_no ?></td>

                                <th>Balance</th>
                                <td class="text-capitalize"><?= formatNaira($student->fee_amount) ?></td>
                            </tr>
                            <tr>
                                <th>Degree</th>
                                <td class="text-capitalize"><?= $student->degree ?></td>

                                <th>Level</th>
                                <td class="text-capitalize"><?= $student->level ?></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td class="text-capitalize"><?= $student->surname ?></td>

                                <th>Firstname</th>
                                <td class="text-capitalize"><?= $student->firstname ?></td>
                            </tr>
                            <tr>
                                <th>Lastname</th>
                                <td class="text-capitalize"><?= $student->lastname ?></td>

                                <th>Email</th>
                                <td class=""><?= $student->email ?></td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td class="text-capitalize"><?= $student->phone ?></td>

                                <th>Date of Birth</th>
                                <td class="text-capitalize"><?= $student->dob ?></td>
                            </tr>
                            <tr>
                                <th>Standing</th>
                                <?php if ($student->standing == 'poor') : ?>
                                    <td class="text-danger fw-bold text-capitalize"><?= $student->standing ?></td>
                                <?php elseif ($student->standing == 'very good' || 'good') : ?>
                                    <td class="text-warning fw-bold text-capitalize"><?= $student->standing ?></td>
                                <?php else : ?>
                                    <td class="text-success fw-bold text-capitalize"><?= $student->standing ?></td>
                                <?php endif; ?>

                                <th>Exam Permission</th>
                                <?php if ($student->ass_permission == 'accepted') : ?>
                                    <td class="text-success fw-bold text-capitalize"><?= $student->ass_permission ?></td>
                                <?php else : ?>
                                    <td class="text-danger fw-bold text-capitalize"><?= $student->ass_permission ?></td>
                                <?php endif; ?>
                            </tr>
                        </table>
                        <?php if (empty($extUser)) : ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col">
                                    <a href="/admin/users/create/new?matriculation_no=<?= $student->matriculation_no ?>" class="btn btn-sm btn-primary w-50">Verify</a>
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