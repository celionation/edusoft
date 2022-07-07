<?php


use core\Config;

$this->title = 'Error Page';

?>

<div class="container col-xl-12 col-xxl-10 px-2 py-5 border border-danger border-3 mt-5 text-center">
    <div class="col-lg-12 p-3 text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3 text-danger">
            <h1 class="bg-dark text-white p-3 mt-1 text-end"><span class="text-danger fw-bold">Lara</span>ton Framework <small class="text-danger h6"><?= Config::get('version') ?></small></h1><span class="fw-bold text-info">Oops! &spades;</span> | CODE: <?= $exception->getCode() ?>
        </h1>
        <h1 class="fw-bold lh-1 mt-3 text-center"><?= $exception->getMessage() ?></h1>
        <div class="divider mt-4 mb-4 border-bottom border-danger border-5"></div>
        <p class="col-lg-10 text-center mx-auto fs-1"><i class="fas fa-smile-wink fa-x3"></i></p>
    </div>
    <div class="col-md-12 mx-auto col-lg-12 mt-5">
        <a href="/" class="btn btn-danger btn-lg w-25">Back to Home</a>
    </div>
</div>
