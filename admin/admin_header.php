<?php
ob_start();
session_start();
include "../config/db.php";

if (isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['user_name'] = $_COOKIE['user_name'];
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['user_role'] = $_COOKIE['user_role'];

    if ($_SESSION['user_role'] == 'Normal User') {
        header("Location: ../index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STEM | Admin</title>
    <link rel="manifest" href="../assets/img/favicons/manifest.json">
    <meta name="theme-color" content="#ffffff">
    <script src="../assets/js/config.navbar-vertical.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="../assets/lib/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="../assets/lib/datatables-bs4/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.css" rel="stylesheet">
    <link href="../assets/css/theme.css" rel="stylesheet">
    <link href="../assets/lib/flatpickr/flatpickr.min.css" rel="stylesheet">
    <link href="../assets/lib/select2/select2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <main class="main" id="top">
        <div class="container-fluid pl-0" data-layout="container">
            <nav class="navbar navbar-vertical navbar-expand-xl navbar-light navbar-inverted">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand" href="dashboard.php">
                        <div class="d-flex align-items-center py-3">
                            <a class="font-weight-bold text-black text-decoration-none fs-3 ml-3" href='../index.php'>STEM</a>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse bg-dark" id="navbarVerticalCollapse">
                    <div class="navbar-vertical-content perfect-scrollbar scrollbar">
                        <ul class="navbar-nav flex-column">
                            <li class='nav-item'>
                                <a class='nav-link' href='dashboard.php'>Dashboard</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='categories.php'>Categories</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='articles.php'>Articles</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='users.php'>Users</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='messages.php'>Messages</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <nav class="navbar navbar-light navbar-dark navbar-top sticky-kit navbar-expand">
                    <button class="btn navbar-toggler-humburger-icon navbar-toggler mr-1 mr-sm-3" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
                        <span class="navbar-toggle-icon">
                            <span class="toggle-line"></span>
                        </span>
                    </button>
                    <a class="navbar-brand mr-1 mr-sm-3" href="orders.php">
                        <div class="d-flex align-items-center">
                            <span class="text-sans-serif">STEM</span>
                        </div>
                    </a>
                    <ul class="navbar-nav navbar-nav-icons ml-auto flex-row align-items-center">
                        <li class="nav-item dropdown dropdown-on-hover">
                            <a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-xl text-dark">
                                    <span class="far fa-user fs-3" data-fa-transform="shrink-1"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
                                <div class="bg-white rounded-soft py-2">
                                    <a class="dropdown-item text-primary" href="#!">Hello, <?php if (isset($_SESSION['user_id'])) {
                                                                                                echo $_SESSION['user_name'];
                                                                                            } ?></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../logout.php">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>