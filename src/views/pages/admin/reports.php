<?php

use core\helpers\CoreHelpers;
use src\classes\GradingSystem;

$this->title = "Admin Reports";

?>

<?php partials('AdminCrumbs') ?>

<div class="text-end">
    <a class="btn btn-primary" href="/admin/faculties">Faculties</a>
    <a class="btn btn-primary" href="/admin/departments">Departments</a>
</div>

<div>
    <h5 class="text-danger text-center">This page is for running or testing the database queries before implementing.. should be deleted when.</h5>

    <?php
    
    $grade = GradingSystem::Grading(78);

    echo $grade->score;
    

    ?>
</div>