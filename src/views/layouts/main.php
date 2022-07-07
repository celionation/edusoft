<?php


use core\Config;


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('/assets/img/favicon.png') ?>">
    <!-- Remix icons -->
    <link rel="stylesheet" href="<?= asset('/assets/css/all.css') ?>">
    <!-- Swiper.js styles -->
    <link rel="stylesheet" href="<?= asset('/assets/css/bootstrap.min.css') ?>">
    <!-- Custom styles -->
    <link rel="stylesheet" href="<?= asset('/assets/css/style.css') ?>">
    <title>EduSoft | <?= $this->title ?></title>
    <script src="<?= asset('/assets/js/jquery.min.js') ?>"></script>
</head>

<body>

    <?php component('Header') ?>
    <main class="container-fluid mt-2 mb-5">
        {{content}}
    </main>
    <hr class="mb-5">
    <?php component('Footer') ?>

    <script type="application/javascript" src="<?= asset('/assets/js/jquery.min.js') ?>"></script>
    <script type="application/javascript" src="<?= asset('/assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script type="application/javascript" src="/assets/js/main.js?v=<?= Config::get("version") ?>"></script>
</body>

</html>