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
    <link rel="stylesheet" href="<?= asset('/assets/sweetalert2/sweetalert2.min.css') ?>">
    <title>EduSoft | <?= $this->title ?></title>
    <script src="<?= asset('/assets/js/jquery.min.js') ?>"></script>
    <style>
        .nav-item a:hover {
            color: #111 !important;
            background-color: #F1F1F1 !important;
        }

        .active {
            color: #111 !important;
            background-color: #F1F1F1 !important;
        }

        .ck-editor__editable_inline {
            min-height: 400px;
        }

        .is-invalid+.ck-editor .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border-color: crimson;
        }

        button[type='submit'],
        button {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php component('AdminHead') ?>
    <div class="container-fluid">
        <div class="row">
            <?php component('AdminSidebar') ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?= Session::displaySessionAlerts() ?>
                {{content}}
            </main>
        </div>
    </div>

    <script src="<?= asset('/assets/js/jquery.min.js') ?>"></script>
    <script type="application/javascript" src="<?= asset('/assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script type="application/javascript" src="<?= asset('/assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
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