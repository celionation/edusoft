<?php

use core\helpers\StringFormat;
use src\classes\Extras;

$this->title = "Course Lists";


?>

<?= partials('AdminCrumbs') ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="/admin/courses" class="btn btn-sm btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
            </div>

            <hr class="mt-1">

            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Code</th>
                        <th scope="col">Credit</th>
                        <th scope="col">Dept</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Type</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courseLists as $key => $cosList) : ?>
                        <tr>
                            <th scope="row"><?= $key + 1 ?></th>
                            <td class="text-capitalize"><?= $cosList->course_title ?? '---' ?></td>
                            <td class="text-capitalize"><?= $cosList->course_code ?? '---' ?></td>
                            <td class="text-capitalize"><?= $cosList->course_credit ?? '---' ?></td>
                            <td class="text-capitalize"><?= StringFormat::Excerpt($cosList->department, 14) ?? '---' ?></td>
                            <td class="text-capitalize"><?= $cosList->semester ?? '---' ?></td>
                            <td class="text-capitalize"><?= StringFormat::Excerpt($cosList->course_type, 4) ?? '---' ?></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <a href="/admin/courses/<?= $cosList->course_id ?>?faculty=<?= $cosList->faculty ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" onclick="deleteCourse('<?= $cosList->course_id ?>')" data-bs-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function deleteCourse(id) {
        if (window.confirm("Are you sure you want to delete this Course? This cannot be undone!")) {
            window.location.href = `/admin/courses/delete/${id}`;
        }
    }
</script>