<?php

use core\helpers\CoreHelpers;

$this->title = "Staffs Portal";

?>

<?= partials('StaffCrumbs') ?>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-start">
        <h5 class="text-muted">Session: 2021/2022<span> First Semester</span></h5>
    </div>
    <div class="text-end">
        <a href="/assessments/to_mark" class="btn btn-sm btn-warning position-relative"><i class="fas fa-sync"></i>
            <?php if ($tomarkTotal > 0) : ?>
                <span class="position-absolute end-0 badge bg-danger rounded-circle" style="top: -6px;"><?= $tomarkTotal ?></span>
            <?php endif; ?>
            Exam To Mark
        </a>
        <a href="/assessments/marked" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Exam Marked</a>
    </div>
</div>