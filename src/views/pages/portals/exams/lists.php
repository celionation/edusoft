<?php

use core\forms\Form;

$this->title = "Examination Questions Selection";

?>

<?= partials('StaffCrumbs'); ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive table-hover table-dark">
                    <thead>
                        <tr>
                            <th><i class="fas fa-arrow-alt-circle-right"></i></th>
                            <th>Title</th>
                            <th>Session</th>
                            <th>Semester</th>
                            <th>Level</th>
                            <th>Course Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assessments as $assessment) : ?>
                            <tr>
                                <th>
                                    <a href="/lecturer/exam/question/view/<?= $assessment->assessment_id ?>" class="btn btn-sm btn-primary"><i class="fas fa-chevron-right px-2"></i></a>
                                </th>
                                <td><?= $assessment->assessment_title ?></td>
                                <td><?= $assessment->session ?></td>
                                <td><?= $assessment->assessment_semester ?></td>
                                <td><?= $assessment->course_level ?></td>
                                <td><?= $assessment->course_code ?></td>
                                <td>
                                    <a href="/lecturer/exam/questions/<?= $assessment->assessment_id ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="/lecturer/exam/questions/delete/<?= $assessment->assessment_id ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>