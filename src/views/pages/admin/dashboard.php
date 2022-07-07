<?php

use core\helpers\CoreHelpers;

$this->title = "Admin Dashboard";

?>

<?php partials('AdminCrumbs') ?>

<div class="text-end">
    <a class="btn btn-primary" href="/admin/courses">Courses</a>
    <a class="btn btn-primary" href="/admin/faculties">Faculties</a>
    <a class="btn btn-primary" href="/admin/departments">Departments</a>
</div>