<?php


use core\Session;


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('/assets/img/favicon.png') ?>">
    <!-- icons -->
    <link rel="stylesheet" href="<?= asset('/assets/css/all.css') ?>">
    <link rel="stylesheet" href="<?= asset('/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('/assets/css/admin.css') ?>">
    <title>EduSoft | <?= $this->title ?></title>
    <script src="<?= asset('/assets/js/jquery-3.6.0.min.js') ?>"></script>
    <style>
        body {
            background: url('/assets/img/logo.png') no-repeat center center;
            height: 100vh;
        }

        .nav-item a:hover {
            color: #111 !important;
            background-color: #F1F1F1 !important;
        }

        .active {
            color: #111 !important;
            background-color: #F1F1F1 !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php component('ExamDetails') ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?= Session::displaySessionAlerts() ?>
                {{content}}
            </main>
        </div>
    </div>

    <script type="application/javascript" src="<?= asset('/assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>

</html>