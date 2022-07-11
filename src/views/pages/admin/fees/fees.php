<?php

use core\forms\Form;

$this->title = "Fees";

?>

<?= partials('AdminCrumbs'); ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <a class="btn btn-primary btn-sm" href="/admin/institute_fees/lists">Fee Lists
                        <?php if ($feesCount > 0) : ?>
                            <span class="badge bg-danger rounded-circle"><?= $feesCount ?></span>
                        <?php endif; ?>
                    </a>
                </div>
                <small class="text-danger">
                    Select Faculty First To Process New Fees for a particular department.
                </small>
                <form action="" method="post">
                    <?= Form::csrfField(); ?>
                    <div class="row g-3 my-1">
                        <div class="col-md-12">
                            <?= Form::selectField('Faculty', 'faculty', '', $faculty, ['class' => 'form-control'], ['class' => 'mb-3 col'], $errors); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary">Proceed <i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>