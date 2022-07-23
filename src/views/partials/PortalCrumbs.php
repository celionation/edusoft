<?php

/** @var mixed $currentUser */

global $currentUser;


?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom mt-5">
    <h4 class="text-danger mt-2">Welcome <span class="text-primary"><?= $currentUser->surname . ' ' . $currentUser->firstname ?></span></h4>
    <h5 class="text-danger">Matric No: <span class="text-muted text-uppercase"><?= $currentUser->code_id ?></span></h5>
</div>