<?php

use src\classes\Extras;

$this->title = "Course Lists";


?>

<?= partials('AdminCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="">All Course Lists</h2>
                </div>

                <hr class="mt-1">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Faculty</th>
                            <th scope="col">Lecturer</th>
                            <th scope="col">Ass.Lecturer</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courseLists as $key => $cosList) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td class="text-capitalize"><?= $cosList->course ?? '---' ?></td>
                                <td class="text-capitalize"><?= $cosList->department ?? '---' ?></td>
                                <td class="text-capitalize"><?= $cosList->faculty ?? '---' ?></td>
                                <td class="text-capitalize"><?= $cosList->position . '.' . $cosList->surname . ' ' . $cosList->firstname ?? '---' ?></td>
                                <td class="text-capitalize"><?= Extras::getAssLeturer($cosList->ass_lecturer) ?></td>
                                <td class="text-end">
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
</div>

<script>
    function deleteCourse(id) {
        if (window.confirm("Are you sure you want to delete this Course? This cannot be undone!")) {
            window.location.href = `/admin/courses/delete/${id}`;
        }
    }
</script>