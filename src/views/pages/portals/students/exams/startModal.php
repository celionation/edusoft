<?php

use src\classes\Extras;

$this->title = "Student Examination Start.";

?>

<?= partials('PortalCrumbs') ?>

<div class="modal modal-alert position-static d-block py-5" tabindex="-1" role="dialog" id="modalChoice">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-body p-4 text-center">
                <h5 class="mb-0 border-bottom border-3 border-danger">Examination Details</h5>
                <p class="text-danger mt-1">Please, Read carefully before starting.</p>
                <table class="table table-responsive">
                    <tr>
                        <th class="text-start">Faculty:</th>
                        <td class="text-end text-capitalize"><?= $assessment->faculty ?></td>
                    </tr>
                    <tr>
                        <th class="text-start">Department:</th>
                        <td class="text-end text-capitalize"><?= $assessment->department ?></td>
                    </tr>
                    <tr>
                        <th class="text-start">Course Title:</th>
                        <td class="text-end text-capitalize"><?= $assessment->assessment_title ?></td>
                    </tr>
                    <tr>
                        <th class="text-start">Course Code:</th>
                        <td class="text-end text-capitalize"><?= $assessment->course_code ?></td>
                    </tr>
                    <tr>
                        <th class="text-start">Level:</th>
                        <td class="text-end text-capitalize"><?= $assessment->course_level ?></td>
                    </tr>
                    <tr>
                        <th class="text-start">Lecturer:</th>
                        <td class="text-end text-capitalize"><?= Extras::getLeturer($assessment->user_id) ?></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer flex-nowrap p-0">
                <button type="button" onclick="startBtn('<?= $assessment->assessment_id ?>', '<?= $matriculation_no ?>', '<?= $user_id ?>')" class="btn btn-lg btn-primary fs-6 text-decoration-none col-6 m-0 rounded-0 border-right"><strong>Start</strong></button>
                <button type="button" onclick="cancelBtn()" class="btn btn-lg btn-danger fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal">No thanks</button>
            </div>
        </div>
    </div>
</div>

<script>
    function startBtn(id, matricNo, userId, type) {
        window.location.href = `/student/exam/${id}?matriculation_no=${matricNo}&user_id=${userId}`;
    }

    function cancelBtn() {
        window.location.href = `/student/exams`;
    }
</script>