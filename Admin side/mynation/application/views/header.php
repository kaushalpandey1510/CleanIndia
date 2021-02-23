<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">

        <!-- FavIcon-->
        
        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/icon/favicon.png" type="image/x-icon"/>
        

        <!-- Fontfaces CSS-->
        <link href="<?php echo base_url() ?>assets/css/font-face.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

        <!-- Bootstrap CSS-->
        <link href="<?php echo base_url() ?>assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

        <!-- Vendor CSS-->
        <link href="<?php echo base_url() ?>assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>assets/vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>assets/vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="<?php echo base_url() ?>assets/css/theme.css" rel="stylesheet" media="all">

        `       <!-- Drop Zone-->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/dropzone/dropzone.css" />
        <script src="<?php echo base_url() ?>assets/vendor/dropzone/dropzone.js"></script>

        <!-- Jquery JS-->
        <script src="<?php echo base_url() ?>assets/vendor/jquery-1.12.4.min.js"></script>
        <!-- CSS For Validation -->

        <link rel="stylesheet"
              href="<?php echo base_url() ?>assets/validation/dist/css/formValidation.css" />

        <!-- JS For Validation -->

        <script type="text/javascript"
        src="<?php echo base_url() ?>assets/validation/dist/js/formValidation.js"></script>

        <script type="text/javascript"
        src="<?php echo base_url() ?>assets/validation/dist/js/framework/bootstrap.js"></script>

    </head>

    <body class="animsition">
        <div class="page-wrapper">
            <!-- HEADER MOBILE-->
            <header class="header-mobile d-block d-lg-none">
                <div class="header-mobile__bar">
                    <div class="container-fluid">
                        <div class="header-mobile-inner">
                            <a class="logo" href="index.html">
                                <img src="<?php echo base_url() ?>assets/images/icon/final_logo.png" alt="Swachh Bharat" />
                            </a>
                            <button class="hamburger hamburger--slider" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="navbar-mobile">
                    <div class="container-fluid">
                        <ul class="navbar-mobile__list list-unstyled">
                            <?php
                            if ($this->session->userdata('role') == 'admin') {
                                ?>
                                <li>
                                    <a class="js-arrow" href="<?php echo base_url() ?>admin/welcome">
                                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                                </li>
                                <li>
                                    <a class="js-arrow" href="<?php echo base_url() ?>admin/complaint">
                                        <i class="fas fa-th-list"></i>Complaints</a>

                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>admin/category">
                                        <i class="fas fa-outdent"></i>Category</a>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa fa-users"></i>Ministry</a>
                                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                        <li>
                                            <a href="<?php echo base_url() ?>admin/ministry">Ministry</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() ?>admin/ministry/add">Add Ministry</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>admin/event_type">
                                        <i class="fas fa-newspaper"></i>Event Type</a>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa fa-calendar-alt"></i>Events</a>
                                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                        <li>
                                            <a href="<?php echo base_url() ?>admin/event/add">Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() ?>admin/event">List</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>admin/public_place">
                                        <i class="fas fa fa-building"></i>Public Places</a>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li class="active has-sub">
                                    <a class="js-arrow" href="<?php echo base_url() ?>welcome">
                                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                                </li>
                                <li>
                                    <a class="js-arrow" href="<?php echo base_url() ?>complaint">
                                        <i class="fas fa-th-list"></i>Complaints</a>

                                </li>
                                <li>
                                    <a class="js-arrow" href="<?php echo base_url() ?>event">
                                        <i class="fas fa fa-calendar-alt"></i>Events</a>

                                </li>
                                
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- END HEADER MOBILE-->

            <!-- MENU SIDEBAR-->
            <aside class="menu-sidebar d-none d-lg-block">
                <div class="logo">
                    <a href="#">
                        <img src="<?php echo base_url() ?>assets/images/icon/final_logo.png" alt="Swachha Bharat" />
                    </a>
                </div>
                <div class="menu-sidebar__content js-scrollbar1">
                    <nav class="navbar-sidebar">
                        <ul class="list-unstyled navbar__list">

                            <?php
                            if ($this->session->userdata('role') == 'admin') {
                                ?>
                                <li>
                                    <a class="js-arrow" href="<?php echo base_url() ?>admin/welcome">
                                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                                </li>
                                <li>
                                    <a class="js-arrow" href="<?php echo base_url() ?>admin/complaint">
                                        <i class="fas fa-th-list"></i>Complaints</a>

                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>admin/category">
                                        <i class="fas fa-outdent"></i>Category</a>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa fa-users"></i>Ministry</a>
                                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                        <li>
                                            <a href="<?php echo base_url() ?>admin/ministry">Ministry</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() ?>admin/ministry/add">Add Ministry</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>admin/event_type">
                                        <i class="fas fa-newspaper"></i>Event Type</a>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa fa-calendar-alt"></i>Events</a>
                                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                        <li>
                                            <a href="<?php echo base_url() ?>admin/event/add">Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() ?>admin/event">List</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>admin/public_place">
                                        <i class="fas fa fa-building"></i>Public Places</a>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li class="active has-sub">
                                    <a class="js-arrow" href="<?php echo base_url() ?>welcome">
                                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                                </li>
                                <li>
                                    <a class="js-arrow" href="<?php echo base_url() ?>complaint">
                                        <i class="fas fa-th-list"></i>Complaints</a>

                                </li>
                                <li>
                                    <a class="js-arrow" href="<?php echo base_url() ?>event">
                                        <i class="fas fa-calendar-alt"></i>Events</a>

                                </li>
                                
                                <?php
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END MENU SIDEBAR-->

            <!-- PAGE CONTAINER-->
            <div class="page-container">
                <!-- HEADER DESKTOP-->
                <header class="header-desktop">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="header-wrap">
                                <form class="form-header" action="" method="POST">
                                    
                                </form>
                                <div class="header-button">

                                    <div class="account-wrap">
                                        <div class="account-item clearfix js-item-menu">

                                            <div class="content">
                                                <a class="js-acc-btn" href="#">

                                                    <?php
                                                    if ($this->session->userdata('role') == 'admin') {
                                                                                                                                                                                                         
                                                    echo 'Welcome,  ', $this->session->userdata('admin_name');
                                                    } else {
                                                        echo $this->session->userdata('ministry_name');
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="account-dropdown js-dropdown">

                                                <?php
                                                if ($this->session->userdata('role') == 'admin') {
                                                    ?>
                                                    <div class="account-dropdown__body">
                                                        <div class="account-dropdown__item">
                                                            <a href="<?php echo base_url() ?>admin/account/password">
                                                                <i class="zmdi zmdi-account"></i>Change Password</a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="account-dropdown__body">
                                                        <div class="account-dropdown__item">
                                                            <a href="<?php echo base_url() ?>account/profile">
                                                                <i class="zmdi zmdi-account"></i>Edit Profile</a>
                                                        </div>
                                                        <div class="account-dropdown__item">
                                                            <a href="<?php echo base_url() ?>account/password">
                                                                <i class="zmdi zmdi-settings"></i>Change Password</a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>


                                                <div class="account-dropdown__footer">
                                                    <?php
                                                    if ($this->session->userdata('role') == 'admin') {
                                                        ?>
                                                        <a href="<?php echo base_url() ?>admin/login/logout">
                                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="<?php echo base_url() ?>login/logout">
                                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                                            <?php
                                                        }
                                                        ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- HEADER DESKTOP-->