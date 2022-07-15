<?php

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
        <div class="exam-questions">
            <div class="col mb-3 shadow border-top border-3 border-danger py-1 examQ">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="bg-primary p-1 text-white rounded">Question #1</div>
                        </div>
                        <h5 class="card-title mt-1">What is Marketing?</h5>
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
                            <div class="bg-primary p-1 text-white rounded">Question #1</div>
                        </div>
                        <h5 class="card-title mt-1">What is Marketing?</h5>
                        <img src="<?= ROOT . 'assets/img/featured-lg.jpg' ?>" alt="" class="img-thumbnail" style="height:200px;width:400px;object-fit:cover;">
                        <div class="anwser my-2">
                            <textarea name="answer" class="form-control" rows="3" placeholder="Type your answer here..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>