<?php

$this->title = "Lecturer Exams Lists";

?>

<?= partials('PortalCrumbs') ?>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-start">
        <h5 class="text-muted">Session: 2021/2022<span> First Semester</span></h5>
    </div>
    <div class="text-end">
        <a href="/lecturer/exam/questions/new" class="btn btn-sm btn-primary"><i class="fas fa-file-signature"></i> New Examination Question</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <?php if($assessments): ?>
                <table class="table table-responsive table-hover table-dark">
                    <thead>
                        <tr>
                            <th><i class="fas fa-arrow-alt-circle-right"></i></th>
                            <th>Title</th>
                            <th>Session</th>
                            <th>Semester</th>
                            <th>Level</th>
                            <th>Course Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assessments as $assessment) : ?>
                            <tr>
                                <th>
                                    <a href="/lecturer/exam/students/<?= $assessment->assessment_id ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye px-2"></i></a>
                                </th>
                                <td><?= $assessment->assessment_title ?></td>
                                <td><?= $assessment->session ?></td>
                                <td><?= $assessment->assessment_semester ?></td>
                                <td><?= $assessment->course_level ?></td>
                                <td><?= $assessment->course_code ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <h6 class="text-center text-muted py-2 border-bottom border-3 border-danger">No Data yet!.</h6>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteExam(id) {
        if (window.confirm("Are you sure you want to delete this Examination? This cannot be undone!")) {
            window.location.href = `/lecturer/exam/questions/delete/${id}`;
        }
    }
</script>