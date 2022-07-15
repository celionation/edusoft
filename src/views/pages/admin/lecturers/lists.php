<?php

global $currentLink;

$this->title = "Lecturers Lists";

?>

<?= partials('AdminCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="">All Lecturers List</h2>
                </div>

                <hr class="mt-1">

                <?php if ($lecturerLists) : ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Faculty</th>
                                <th scope="col">Department</th>
                                <th scope="col">Position</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lecturerLists as $key => $lecList) : ?>
                                <tr>
                                    <th scope="row"><?= $key + 1 ?></th>
                                    <td class="text-capitalize"><?= $lecList->surname . ' ' . $lecList->firstname . ' ' . $lecList->lastname ?></td>
                                    <td><?= $lecList->faculty ?></td>
                                    <td class="text-capitalize"><?= $lecList->department ?></td>
                                    <td class="text-capitalize"><?= $lecList->position ?></td>
                                    <td class="text-end">
                                        <a href="/admin/lecturers/profile/<?= $lecList->lecturer_id ?>?lecturer_no=<?= $lecList->lecturer_no ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Add Lecturer"><i class="fas fa-eye"></i></a>
                                        <a href="/admin/lecturers/<?= $lecList->lecturer_id ?>?faculty=<?= $lecList->faculty ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteLecList('<?= $lecList->lecturer_id ?>')" data-bs-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <nav aria-label="Pagination">
                        <ul class="d-flex justify-content-evenly align-items-center my-1 pagination">
                            <li class="page-item <?= !$prevPage ? 'disabled' : '' ?>" aria-current="page">
                                <a class="page-link" href="<?= ROOT . $currentLink ?>?page=<?= $prevPage ?>">Prev</a>
                            </li>
                            <li class="page-item <?= !$nextPage ? 'disabled' : '' ?>" aria-current="page">
                                <a class="page-link" href="<?= ROOT . $currentLink ?>?page=<?= $nextPage ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- //Pagination -->
                <?php else : ?>
                    <h6 class="text-center text-danger">No Data yet!.</h6>
                    <a href="<?= ROOT . $currentLink ?>?page=1" class="btn btn-sm btn-primary text-center w-100"><i class="fas fa-chevron-left"></i> Back</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteLecList(id) {
        if (window.confirm("Are you sure you want to delete this Lecturer? This cannot be undone!")) {
            window.location.href = `/admin/lecturers/delete/${id}`;
        }
    }
</script>