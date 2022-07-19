<!-- Pagination -->
<nav aria-label="Pagination">
    <ul class="d-flex justify-content-evenly align-items-center my-1 pagination">
        <li class="page-item <?= !$prevPage ? 'disabled' : '' ?>" aria-current="page">
            <a class="page-link" href="<?= ROOT . $currentLink ?>?<?= $quryStr ?>page=<?= $prevPage ?>">Prev</a>
        </li>
        <li class="page-item <?= !$nextPage ? 'disabled' : '' ?>" aria-current="page">
            <a class="page-link" href="<?= ROOT . $currentLink ?>?<?= $quryStr ?>page=<?= $nextPage ?>">Next</a>
        </li>
    </ul>
</nav>
<!-- //Pagination -->