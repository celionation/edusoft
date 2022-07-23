<?php

$this->title = "Student Results";

?>

<?= partials("PortalCrumbs") ?>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-start">
        <h5 class="text-muted">Session: 2021/2022<span> First Semester</span></h5>
    </div>
    <div class="text-end">

    </div>
</div>

<hr>

<div class="container">
    <div class="card">
        <div class="card-body card-img-overlay">
            <div class="card-header-tabs">
                <h4 class="text-center text-uppercase border-bottom border-2 border-danger">Academic Mini Transcript</h4>
            </div>
            <div class="d-flex justify-content-between align-items-center border-bottom border-2 border-danger">
                <div class="details">
                    <table class="table table-borderless">
                        <tr>
                            <th>Full Name:</th>
                            <td>Celio Natti Smith</td>
                        </tr>
                        <tr>
                            <th>Matriculation No:</th>
                            <td>SMS/016/16996</td>
                        </tr>
                        <tr>
                            <th>Faculty:</th>
                            <td>Social and management Science</td>
                        </tr>
                        <tr>
                            <th>Department:</th>
                            <td>Business Administration</td>
                        </tr>
                        <tr>
                            <th>Degree:</th>
                            <td>BSc.</td>
                        </tr>
                    </table>
                </div>
                <div class="img">
                    <img src="/assets/img/user_male.jpg" alt="" class="img-thumbnail rounded-2 py-2 my-2 mx-1" style="height:200px;width:180px;object-fit:cover;">
                </div>
            </div>

            <!-- RESULTS_CONTAINER -->
            <div class="results_container mb-2">
                <div class="d-flex justify-content-between align-items-center py-2 px-2">
                    <h5 class="m-0">Session: <span>2021/2022</span></h5>
                    <h5 class="m-0">Level: <span>100</span></h5>
                    <h5 class="m-0">Semester: <span>First</span></h5>
                </div>
                <table class="table table-responsive border border-danger border-1">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Credit</th>
                            <th>Score</th>
                            <th>Grade</th>
                            <th>Grade Point</th>
                            <th>W. Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>BUS 121</td>
                            <td>Introduction to Marketing I</td>
                            <td>3</td>
                            <td>45</td>
                            <td>D</td>
                            <td>2</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <th>2</th>
                            <td>EES 121</td>
                            <td>Innovations and Project Management Seminar.</td>
                            <td>1</td>
                            <td>72</td>
                            <td>A</td>
                            <td>5</td>
                            <td>5</td>
                        </tr>
                    </tbody>
                    <tfoot class="table-danger">
                        <tr>
                            <th>TC</th>
                            <th>TWGP</th>
                            <th colspan="3">GP</th>
                            <th>CTC</th>
                            <th>CWGP</th>
                            <th>CGPA</th>
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>76</td>
                            <td colspan="3">3.17</td>
                            <td>138</td>
                            <td>395</td>
                            <td>2.86</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="d-flex justify-content-between align-items-center border-bottom border-2 border-danger">
                    <div class="standing">
                        <h6>Remarks: <span class="text-success">GS</span></h6>
                    </div>
                    <div class="class">
                        <h6>Class: <span class="text-warning">Second Class Lower</span></h6>
                    </div>
                </div>
            </div>
            <div class="results_container">
                <div class="d-flex justify-content-between align-items-center py-2 px-2">
                    <h5 class="m-0">Session: <span>2021/2022</span></h5>
                    <h5 class="m-0">Level: <span>100</span></h5>
                    <h5 class="m-0">Semester: <span>Second</span></h5>
                </div>
                <table class="table table-responsive border border-danger border-1">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Credit</th>
                            <th>Score</th>
                            <th>Grade</th>
                            <th>Grade Point</th>
                            <th>W. Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>BUS 123</td>
                            <td>Policy and Marketing Strategy I</td>
                            <td>3</td>
                            <td>75</td>
                            <td>A</td>
                            <td>5</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <th>2</th>
                            <td>EES 122</td>
                            <td>Semanar and Management System.</td>
                            <td>1</td>
                            <td>72</td>
                            <td>A</td>
                            <td>5</td>
                            <td>5</td>
                        </tr>
                    </tbody>
                    <tfoot class="table-danger">
                        <tr>
                            <th>TC</th>
                            <th>TWGP</th>
                            <th colspan="3">GP</th>
                            <th>CTC</th>
                            <th>CWGP</th>
                            <th>CGPA</th>
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>76</td>
                            <td colspan="3">3.17</td>
                            <td>138</td>
                            <td>395</td>
                            <td>2.86</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="d-flex justify-content-between align-items-center border-bottom border-2 border-danger">
                    <div class="standing">
                        <h6>Remarks: <span class="text-success">GS</span></h6>
                    </div>
                    <div class="class">
                        <h6>Class: <span class="text-warning">Second Class Lower</span></h6>
                    </div>
                </div>
            </div>
            <!-- END OF RESULTS_CONTAINER -->
            <table class="table table-responsive table-borderless">
                <caption class="caption-top">Key to Abbreviations</caption>
                <tr>
                    <th>TC</th>
                    <td>Total Credit</td>
                    <th class="text-end">CTC</th>
                    <td class="text-end">Cumulative Total Credit</td>
                </tr>
                <tr>
                    <th>TWGP</th>
                    <td>Total Weighted Grade Point</td>
                    <th class="text-end">CGPA</th>
                    <td class="text-end">Cumulative Grade Point</td>
                </tr>
                <tr>
                    <th>GPA</th>
                    <td>Grade Point Average</td>
                    <th class="text-end">NR</th>
                    <td class="text-end">Not Registered For</td>
                </tr>
                <tr>
                    <th>NA</th>
                    <td>Not Applicable</td>
                    <th class="text-end">REM</th>
                    <td class="text-end">Remarks</td>
                </tr>
                <tr>
                    <th>ABS</th>
                    <td>Absent With Permission</td>
                    <th class="text-end">GS</th>
                    <td class="text-end">In Good Standing</td>
                </tr>
                <tr>
                    <th>W</th>
                    <td>Withdrawal</td>
                    <th class="text-end">NGS</th>
                    <td class="text-end">Not In Good Standing</td>
                </tr>
                <tr>
                    <th>VW</th>
                    <td>Voluntary Withdrawal</td>
                    <th class="text-end">VCL</th>
                    <td class="text-end">Vice Chancellor's List</td>
                </tr>
                <tr>
                    <th>PR1</th>
                    <td>Probation 1</td>
                    <th class="text-end">PR2</th>
                    <td class="text-end">Probation 2</td>
                </tr>
            </table>

            <div class="border-top border-bottom border-1 border-danger my-2">
                <table class="table table-responsive table-borderless">
                    <thead>
                        <th>Grading System</th>
                        <th>Letter Grade</th>
                        <th>Grade Point</th>
                        <th class="text-end">Classification of Degree</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>70 - 100%</td>
                            <td>A</td>
                            <td>5</td>
                            <td class="text-end">First Class <span>4.50 - 5.00</span></td>
                        </tr>
                        <tr>
                            <td>60 - 69%</td>
                            <td>B</td>
                            <td>4</td>
                            <td class="text-end">Second Class (Upper Division) <span>3.50 - 2.39</span></td>
                        </tr>
                        <tr>
                            <td>50 - 59%</td>
                            <td>C</td>
                            <td>3</td>
                            <td class="text-end">Second Class (Lower Division) <span>2.40 - 1.49</span></td>
                        </tr>
                        <tr>
                            <td>40 - 49%</td>
                            <td>D</td>
                            <td>2</td>
                            <td class="text-end">Third Class <span>1.50 - 2.39</span></td>
                        </tr>
                        <tr>
                            <td>0 - 39%</td>
                            <td>F</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>