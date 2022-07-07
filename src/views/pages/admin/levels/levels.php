<?php

use core\forms\Form;

$this->title = "Institution Levels";

?>

<?= partials('AdminCrumbs'); ?>

<div class="my-4">
    <div class="card mt-3">
        <div class="card-header bg-primary">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-white">Levels</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card mt-3">
                            <div class="card-header bg-info">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="text-white"><?= $heading ?></h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <?= Form::csrfField() ?>
                                    <div class="mb-3">
                                        <?= Form::inputField('Level', 'level', $level->level ?? '', ['class' => 'form-control', 'type' => 'text'], ['class' => 'mb-3'], $errors) ?>
                                    </div>
                                    <button type="submit" class="btn btn-md w-100 bg-success text-white"><?= $btn ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <?php if ($level->id == null) : ?>
                            <div class="card mt-3">
                                <div class="card-header bg-warning">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="text-white">Levels</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Level</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($levels as $level) : ?>
                                                <tr>
                                                    <td><?= $level->level ?></td>
                                                    <td>
                                                        <a href="/admin/delete_level/<?= $level->id ?>" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                                                        <a href="/admin/levels/<?= $level->id ?>" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="card mt-3">
                                <div class="card-header bg-danger">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="text-white"><i class="fas fa-exclamation"></i> Notice</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque ipsa nesciunt vero! Perspiciatis ipsa quibusdam nesciunt voluptate dolores, repudiandae doloremque blanditiis perferendis excepturi molestiae veritatis! Nostrum error illo non ea aliquid unde magni nemo et accusantium, nisi dignissimos. Officiis cupiditate ea a officia quis. Iure deserunt accusantium in voluptatem atque?</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>