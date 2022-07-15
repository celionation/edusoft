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
                    <h5 class="">All Students
                        <?php if ($total > 0) : ?>
                            <span class="badge bg-danger rounded-circle"><?= $total ?></span>
                        <?php endif; ?>
                    </h5>

                </div>

                <hr class="mt-1">

                <?php if ($students) : ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Matric No</th>
                                <th scope="col">Level</th>
                                <th scope="col">Standing</th>
                                <th scope="col">Exam.Perm</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $key => $student) : ?>
                                <tr>
                                    <th scope="row"><?= $key + 1 ?></th>
                                    <td class="text-capitalize"><?= $student->surname . ' ' . $student->firstname . ' ' . $student->lastname ?></td>
                                    <td><?= $student->matriculation_no ?></td>
                                    <td><?= $student->level ?></td>
                                    <td><?= $student->standing ?></td>
                                    <td><?= $student->exam_permission ?></td>
                                    <td class="text-end">
                                        <a href="/admin/students/profile/<?= $student->student_id ?>?matriculation_no=<?= $student->matriculation_no ?>" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Preview"><i class="fas fa-eye"></i></a>
                                        <?php if ($student->exam_permission == 'accepted') : ?>
                                            <a href="/admin/students/exam_perm/<?= $student->student_id ?>?matriculation_no=<?= $student->matriculation_no ?>&exam_perm=declined" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Examination Perm Declined"><i class="fas fa-file-excel"></i></a>
                                        <?php else : ?>
                                            <a href="/admin/students/exam_perm/<?= $student->student_id ?>?matriculation_no=<?= $student->matriculation_no ?>&exam_perm=accepted" class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Examination Perm Accepted"><i class="fas fa-file-signature"></i></a>
                                        <?php endif; ?>
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Report Issue"><i class="fas fa-question-circle"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <h5 class="text-center text-muted text-capitalize">No Students Data yet!.</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<!-- Modals -->

<div class="modal fade" id="previewStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="previewStudentLabel" aria-hidden="true">
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
                        <p class="text-danger">here you add the fees details and permission for exam mode. also view some detials and create user acct</p>
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