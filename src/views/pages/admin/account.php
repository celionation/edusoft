<?php

use src\classes\Extras;

$this->title = "Account Page";


?>

<?php partials('AdminCrumbs') ?>

<div class="container-fluid p-4 shadow mx-auto">
    <div class="row">
        <div class="col-sm-4 col-md-5">
            <img src="<?= Extras::GetImage('') ?>" alt="User" class="d-block border border-primary mx-auto rounded-circle" style="width: 150px;">
            <h3 class="text-center pt-2">Celio Natti</h3>
        </div>
        <div class="col-sm-8 col-md-7 p-2">
            <table class="table">
                <tr>
                    <th scope="col">FirstName:</th>
                    <td>Celio</td>
                </tr>
                <tr>
                    <th scope="col">LastName:</th>
                    <td>Natti</td>
                </tr>
                <tr>
                    <th scope="col">E-Mail:</th>
                    <td>Celionatti@mail.com</td>
                </tr>
                <tr>
                    <th scope="col">Gender:</th>
                    <td>Male</td>
                </tr>
                <tr>
                    <th scope="col">Rank:</th>
                    <td>Vice-chancellor</td>
                </tr>
                <tr>
                    <th scope="col">Date Created:</th>
                    <td>22-July-2022</td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <nav>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info" aria-selected="true">Info</button>
                <button class="nav-link" id="nav-course-tab" data-bs-toggle="tab" data-bs-target="#nav-course" type="button" role="tab" aria-controls="nav-course" aria-selected="false">Courses</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae quo provident unde iste ea maiores expedita amet magnam maxime. Consequatur corrupti soluta, delectus consectetur laudantium tempore explicabo dolor unde alias quia, voluptate saepe a autem facilis mollitia, omnis quam? Accusantium possimus ut repellat eligendi sapiente voluptas hic aspernatur adipisci enim!.</p>
            </div>
            <div class="tab-pane fade" id="nav-course" role="tabpanel" aria-labelledby="nav-course-tab">
                <p><strong>This is some placeholder content the Profile tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <p><strong>This is some placeholder content the Contact tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
            </div>
        </div>
    </div>
</div>