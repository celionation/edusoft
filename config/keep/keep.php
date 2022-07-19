<?php

use core\helpers\CoreHelpers;

global $currentLink;
global $quryStr;

$this->title = "Examination";


?>

<div class="card my-2 bg-transparent">
    <div class="card-body">
        <div class="details">
            <h4 class="text-center border-bottom border-3 border-danger">Introduction Business Marketing</h4>
            <table class="table table-hover">
                <tr>
                    <th>Course Code:</th>
                    <td colspan="4" class="text-end">BUS 123</td>
                </tr>
                <tr>
                    <th>Department:</th>
                    <td class="text-end">Business Administration</td>
                    <th class="text-end">Duration:</th>
                    <td class="text-end">1hour 30minutes</td>
                </tr>
                <tr>
                    <th>Instruction:</th>
                    <td colspan="4" class="text-end fw-bold text-uppercase">Answer all question</td>
                </tr>
            </table>
        </div>

        <!-- Exam Questions -->
        <div class="card bg-transparent">
            <div class="col mb-3 shadow border-top border-3 border-danger py-1 examQ">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="bg-primary p-1 text-white rounded">Question #1</div>
                        </div>
                        <h3 class="card-title mt-1">What is Marketing?</h3>
                        <img src="<?= ROOT . 'assets/img/featured-lg.jpg' ?>" alt="" class="img-thumbnail" style="height:200px;width:400px;object-fit:cover;">
                        <div class="anwser my-2">
                            <textarea name="answer" class="form-control" rows="3" placeholder="Type your answer here..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col mb-3 shadow border-top border-3 border-danger py-1 examQ">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="bg-primary p-1 text-white rounded">Question #2</div>
                        </div>
                        <h3 class="card-title my-1">What is Marketing?</h3>
                        <div class="list-group mx-0">
                            <label class="list-group-item d-flex gap-2 my-1">
                                <input class="form-check-input flex-shrink-0" type="radio" name="list" style="transform: scale(1.5);cursor: pointer;">
                                <h6 class="d-block text-black ps-3">With support text underneath to add</h6>
                            </label>
                            <label class="list-group-item d-flex gap-2 my-1">
                                <input class="form-check-input flex-shrink-0" type="radio" name="list" style="transform: scale(1.5);cursor: pointer;">
                                <h6 class="d-block text-black ps-3">With support text underneath to add</h6>
                            </label>
                            <label class="list-group-item d-flex gap-2 my-1">
                                <input class="form-check-input flex-shrink-0" type="radio" name="list" style="transform: scale(1.5);cursor: pointer;">
                                <h6 class="d-block text-black ps-3">With support text underneath to add</h6>
                            </label>
                            <label class="list-group-item d-flex gap-2 my-1">
                                <input class="form-check-input flex-shrink-0" type="radio" name="list" style="transform: scale(1.5);cursor: pointer;">
                                <h6 class="d-block text-black ps-3">With support text underneath to add</h6>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col mb-3 shadow border-top border-3 border-danger py-1 examQ">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="bg-primary p-1 text-white rounded">Question #2</div>
                        </div>
                        <h3 class="card-title my-1">What is Marketing?</h3>
                        <img src="<?= ROOT . 'assets/img/featured-lg.jpg' ?>" alt="" class="img-thumbnail" style="height:200px;width:400px;object-fit:cover;">
                        <div class="anwser my-2">
                            <div class="list-group mx-0">
                                <label class="list-group-item d-flex gap-2 my-1">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="list" style="transform: scale(1.5);cursor: pointer;">
                                    <h6 class="d-block text-black ps-3">With support text underneath to add</h6>
                                </label>
                                <label class="list-group-item d-flex gap-2 my-1">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="list" style="transform: scale(1.5);cursor: pointer;">
                                    <h6 class="d-block text-black ps-3">With support text underneath to add</h6>
                                </label>
                                <label class="list-group-item d-flex gap-2 my-1">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="list" style="transform: scale(1.5);cursor: pointer;">
                                    <h6 class="d-block text-black ps-3">With support text underneath to add</h6>
                                </label>
                                <label class="list-group-item d-flex gap-2 my-1">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="list" style="transform: scale(1.5);cursor: pointer;">
                                    <h6 class="d-block text-black ps-3">With support text underneath to add</h6>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Pagination">
                <ul class="d-flex justify-content-evenly align-items-center my-1 pagination">
                    <li class="page-item <?= !$prevPage ? 'disabled' : '' ?>" aria-current="page">
                        <a class="page-link" href="<?= ROOT . $currentLink ?>?<?= $quryStr ?>&page=<?= $prevPage ?>">Prev</a>
                    </li>
                    <li class="page-item <?= !$nextPage ? 'disabled' : '' ?>" aria-current="page">
                        <a class="page-link" href="<?= ROOT . $currentLink ?>?<?= $quryStr ?>&page=<?= $nextPage ?>">Next</a>
                    </li>
                </ul>
            </nav>
            <!-- //Pagination -->
        </div>
    </div>