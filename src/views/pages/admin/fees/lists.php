<?php

global $currentLink;

$this->title = "Fee Lists";


?>

<?= partials('AdminCrumbs') ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="">All Fee Lists</h2>
            </div>

            <hr class="mt-1">

            <?php if ($feeLists) : ?>
                <table class="table table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Faculty</th>
                            <th scope="col">Department</th>
                            <th scope="col">Amount</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($feeLists as $key => $feeList) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td class="text-capitalize"><?= $feeList->faculty ?? '---' ?></td>
                                <td class="text-capitalize"><?= $feeList->department ?? '---' ?></td>
                                <td class="text-capitalize"><?= $feeList->amount ?? '---' ?></td>
                                <td class="text-end">
                                    <a href="/admin/institute_fees/<?= $feeList->fee_id ?>?faculty=<?= $feeList->faculty ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteFee('<?= $feeList->fee_id ?>')" data-bs-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
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

<script>
    function deleteFee(id) {
        if (window.confirm("Are you sure you want to delete this Institute Fee? This cannot be undone!")) {
            window.location.href = `/admin/institute_fees/delete/${id}`;
        }
    }
</script>