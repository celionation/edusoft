<?php


?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="./assets/img/logo.png" alt="" style="width: 65px; width: 45px;">
            <small>Nattisight</small>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Portals</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown04">
                        <li><a class="dropdown-item" href="/students_portal">Students</a></li>
                        <li><a class="dropdown-item" href="/staffs_portal">Staff's</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Misc Portal</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown04">
                        <li><a class="dropdown-item" href="/cont_asses">Cont.Asses</a></li>
                        <li><a class="dropdown-item" href="/exam">Exam</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="search-btn"><span class="fas fa-search"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- __________________SEARCH BOX___________________ -->
<form action="" method="post" class="search-form">
    <input type="search" id="search-box" placeholder="Search here...">
    <label for="search-box" class="fas fa-search"></label>
</form>
<!-- __________________END OF SEARCH BOX___________________ -->