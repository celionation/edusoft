<?php

$this->title = "Student Courses";

?>

<?= partials("PortalCrumbs") ?>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-start">
        <h5 class="text-muted">Session: 2021/2022<span> First Semester</span></h5>
    </div>
    <div class="text-end">
        <a class="btn btn-sm btn-primary" href="/student/courses/registration">Course Registration</a>
        <a class="btn btn-sm btn-warning" href="#">Outstanding Course</a>
    </div>
</div>

<hr>

<div class="container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Course Title</th>
                <th>Course Code</th>
                <th>Course Credit</th>
                <th>Course Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>1</th>
                <td>Human Resources Management</td>
                <td>BUS 321</td>
                <td>3</td>
                <td>Compulsory</td>
                <td>Registered</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Total Outstanding Credits: 9</th>
                <th class="text-end">Total Allowed Credit Remaining: 3</th>
            </tr>
        </tfoot>
    </table>
</div>