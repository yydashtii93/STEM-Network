<?php
ob_start();
session_start();
include "config/db.php";

// Validate if user is logged in, 
// and assign cookies values to session values
if (isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['user_name'] = $_COOKIE['user_name'];
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['user_role'] = $_COOKIE['user_role'];
}

// Categories list in the navbar
function navbar_categories()
{
    global $db_connect;

    $get_categories = "SELECT * FROM categories ORDER BY category_name ASC";
    $res_categories = mysqli_query($db_connect, $get_categories);
    while ($row = mysqli_fetch_assoc($res_categories)) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];

        echo "<a class='dropdown-item fs-0 font-weight-bold' href='category.php?c=" . $category_id . "'>" . $category_name . "</a>";
    }
}
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'>
    <title>STEM</title>
    <meta name='theme-color' content='#ffffff'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal">
    <link href='assets/css/theme.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

</head>

<body>
    <main class="main" id="top">

        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-black fs--1" style="position:fixed;">
            <div class="container">

                <!-- LOGO -->
                <a class='navbar-brand' href='index.php'>
                    <img class='fit-contain' src='assets/img/logos/logo.svg' style='height:50px;width:70px;'>
                </a>

                <!-- ICON HAMBURGER -->
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fas fa-bars fs-2 text-white"></span>
                </button>

                <!-- HAMBURGER PAGES MENU -->
                <div class="collapse navbar-collapse" id="navbarStandard">
                    <ul class="navbar-nav">

                        <li class='nav-item'>
                            <a class='index_loader nav-link text-white font-weight-bold fs-0' href='index.php' role='button'>
                                Home
                            </a>
                        </li>

                        <li class='nav-item dropdown dropdown-on-hover font-weight-bold'>
                            <a class='nav-link dropdown-toggle text-white font-weight-bold fs-0' id='navbarDropdownHome' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Categories</a>
                            <div class='dropdown-menu dropdown-menu-card' aria-labelledby='navbarDropdownHome'>
                                <div class='bg-white rounded-soft py-2'>
                                    <?php navbar_categories(); ?>
                                </div>
                            </div>
                        </li>

                        <li class='nav-item'>
                            <a class='nav-link text-white font-weight-bold fs-0' href='contact.php' role='button'>
                                Contact
                            </a>
                        </li>

                        <li class='nav-item'>
                            <div class="nav-link">
                                <form action="search.php" method="post">
                                    <input class="form-control form-control-sm bg-200 fs--1" type="text" name="search_text" placeholder="Search..." required>
                                </form>
                            </div>
                        </li>

                    </ul>

                    <!-- VALIDATE IF USER IS LOGGED IN OR NOT & DISPLAY RESPECTIVE PAGES -->
                    <?php if (isset($_SESSION['user_email'])) { ?>
                        <ul class='navbar-nav ml-auto'>
                            <?php if ($_SESSION['user_role'] == 'Admin User') { ?>
                                <li class='nav-item'>
                                    <a class='nav-link text-white font-weight-bold fs-0' href='admin/dashboard.php'>Dashboard</a>
                                </li>
                            <?php } ?>
                            <li class='nav-item dropdown dropdown-on-hover font-weight-bold'>
                                <a class='nav-link dropdown-toggle text-white font-weight-bold fs-0' id='navbarDropdownHome' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Account</a>
                                <div class='dropdown-menu dropdown-menu-card' aria-labelledby='navbarDropdownHome'>
                                    <div class='bg-white rounded-soft py-2'>
                                        <a class='dropdown-item fs-0 font-weight-bold' href='account.php'>Account</a>
                                        <hr>
                                        <a class='dropdown-item fs-0 font-weight-bold' href='logout.php'>Log out</a>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    <?php } else { ?>
                        <ul class='navbar-nav ml-auto'>
                            <li class='nav-item'>
                                <a class='nav-link text-white font-weight-bold fs-0' href='login.php'>Account</a>
                            </li>
                        </ul>
                    <?php } ?>

                </div>
            </div>
        </nav>