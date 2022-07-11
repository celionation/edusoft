<?php

$this->title = "Admission Lists";

?>

<?= partials('AdminCrumbs') ?>

<div class="row">
    <div class="col-md-12 mx-auto shadow p-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <?php if (!isset($_GET['list'])) : ?>
                        <h5 class="text-muted">Admission on Progress</h5>
                        <div>
                            <a href="/admin/admission/lists/admitted?list=admitted" class="btn btn-sm btn-primary">Admitted Lists</a>
                        </div>
                    <?php else : ?>
                        <h5 class="text-muted">Admitted Students</h5>
                        <div>
                            <a href="/admin/admission/lists" class="btn btn-sm btn-info">Progress Lists</a>
                        </div>
                    <?php endif; ?>
                </div>

                <hr class="mt-1">

                <?php if ($admissionLists) : ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Faculty</th>
                                <th scope="col">Department</th>
                                <th scope="col">Degree</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admissionLists as $key => $admList) : ?>
                                <tr>
                                    <th scope="row"><?= $key + 1 ?></th>
                                    <td class="text-capitalize"><?= $admList->surname . ' ' . $admList->firstname . ' ' . $admList->lastname ?></td>
                                    <td><?= $admList->faculty ?></td>
                                    <td class="text-capitalize"><?= $admList->department ?></td>
                                    <td class="text-capitalize"><?= $admList->degree ?></td>
                                    <td class="text-end">
                                        <?php if (!empty($admList->matriculation_no) && $admList->status != 'progress') : ?>
                                            <a href="/admin/admission/verify/<?= $admList->surname ?>?matriculation_no=<?= $admList->matriculation_no ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Admit Student"><i class="fas fa-check-circle"></i></a>
                                        <?php endif; ?>
                                        <a href="/admin/admission/<?= $admList->admission_id ?>?faculty=<?= $admList->faculty ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteList('<?= $admList->admission_id ?>')" data-bs-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <h5 class="text-center text-muted">No Students data yet!.</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteList(id) {
        if (window.confirm("Are you sure you want to delete this Candidate? This cannot be undone!")) {
            window.location.href = `/admin/admission/delete/${id}`;
        }
    }
</script>