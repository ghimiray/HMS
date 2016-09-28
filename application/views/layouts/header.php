<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo @$site_title ?></title>
    <link href="<?php echo base_url('assets') ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/js/ui/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/js/ui/jquery-ui.theme.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('assets') ?>/js/html5shiv.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo base_url('assets') ?>/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?php echo base_url('assets') ?>/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?php echo base_url('assets') ?>/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?php echo base_url('assets') ?>/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed"
          href="<?php echo base_url('assets') ?>/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('') ?>"><i class="icon-home"></i><img
                    src="<?php echo base_url('assets') ?>/images/logo.png" alt="logo"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="<?php echo base_url('') ?>">Home</a></li>
                <li><a href="<?php echo base_url('rooms-and-reservations') ?>">Reservation</a></li>
                <li><a href="<?php echo base_url('restaurant-and-menu') ?>">Restaurant</a></li>
                <li><a href="<?php echo base_url('transportation-service') ?>">Transportation</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Services <i
                            class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('event-hall') ?>">Event Hall</a></li>
                        <li><a href="<?php echo base_url('gym-and-fitness') ?>">Gym and Fitness</a></li>
                        <li><a href="<?php echo base_url('laundry-service') ?>">Laundry Service</a></li>
                        <li><a href="<?php echo base_url('vehicle-parking') ?>">Vehicle Parking</a></li>
                    </ul>
                </li>

                <li><a href="<?php echo base_url('') ?>about">About Us</a></li>

                <li><a href="<?php echo base_url('') ?>contact">Contact</a></li>
                <li><a>|</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?php echo (UID and USER_GROUP) ? FULLNAME : ' Account'?> <i
                            class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu">
                        <?php
                        if (UID and USER_GROUP) {

                            if ((int) USER_GROUP == 3) { ?>
                                <li><a href="<?php echo base_url('my-account') ?>"><i class="icon-book"></i> My Account</a></li>
                                <li><a href="<?php echo base_url('logout') ?>"><i class="icon-lock"></i> Logout</a></li>


                            <?php } elseif(USER_GROUP==2 or USER_GROUP==1) { ?>
                                <li><a href="<?php echo base_url('dashboard') ?>"><i class="icon-dashboard"></i> Manage Application</a></li>
                                <li><a href="<?php echo base_url('logout') ?>"><i class="icon-lock"></i> Logout</a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <li><a href="<?php echo base_url('login') ?>"><i class="icon-lock"></i> Login</a></li>
                            <li><a href="<?php echo base_url('register') ?>"><i class="icon-chevron-sign-up"></i> Create
                                    Account</a></li>
                        <?php }
                        ?>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</header><!--/header-->
