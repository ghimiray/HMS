<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($title) ? $title : 'HotelManagement' ?></title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="<?php echo base_url('assets') ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
          rel="stylesheet">
    <link href="<?php echo base_url() ?>css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/pages/dashboard.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/pages/signin.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>js/guidely/guidely.css" rel="stylesheet">


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body style="margin-bottom: 50px;">
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a
                class="brand" href="<?php echo base_url() ?>"><i class="icon-home"></i> <?php echo HOTEL_NAME ?></a>
            <?php
            if (UID) {
                ?>
                <div class="nav-collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="icon-user"></i> <?php echo FULLNAME ?><b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() ?>login/logout">Logout</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo DEPARTMENT_NAME ?></a>
                        </li>
                    </ul>
                    <form class="navbar-search pull-right" action="/search" method="POST">
                        <input type="text" name="customer" class="search-query" placeholder="Search Customer">
                    </form>
                </div>
            <?php } ?>
        </div>
        <!-- /container -->
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<?php
if (UID) {
    ?>
    <div class="subnavbar">
        <div class="subnavbar-inner">
            <div class="container">
                <ul class="mainnav">
                    <?php
                    $navigation = array();

                    $navigation[] = [
                        'page' => 'dashboard',
                        'name' => 'Dashboard',
                        'icon' => 'dashboard',
                        'department_id' => '0',
                        'link' => base_url('dashboard')
                    ];
                    $navigation[] = [
                        'page' => 'company',
                        'name' => 'Company',
                        'icon' => 'home',
                        'department_id' => '1',
                        'link' => base_url('company')
                    ];
                    $navigation[] = [
                        'page' => 'employee',
                        'name' => 'Employee',
                        'icon' => 'user',
                        'department_id' => '2',
                        'link' => base_url('employee')
                    ];
                    $navigation[] = [
                        'page' => 'reservation',
                        'name' => 'Reservation',
                        'icon' => 'list-alt',
                        'department_id' => '3',
                        'link' => base_url('reservation')
                    ];
                    $navigation[] = [
                        'page' => 'rooms_and_types',
                        'name' => 'Rooms',
                        'icon' => 'home',
                        'department_id' => '4',
                        'link' => base_url(''),
                        'children' => [
                            [
                                'page' => 'rooms',
                                'name' => 'rooms',
                                'link' => base_url('room')
                            ],
                            [
                                'page' => 'room_type',

                                'name' => 'Room Type',
                                'link' => base_url('room-type')
                            ]
                        ]
                    ];
                    $navigation[] = [
                        'page' => 'departments',
                        'name' => 'departments',
                        'icon' => 'file',
                        'department_id' => '5',
                        'link' => base_url('departments')
                    ];
                    $navigation[] = [
                        'page' => 'restaurants_and_menus',
                        'name' => 'Restaurants & Menus',
                        'icon' => 'fire',
                        'department_id' => '6',
                        'link' => base_url('restaurant'),
                        'children' => [
                            [
                                'page' => 'restaurants',
                                'name' => 'Restaurants',
                                'link' => base_url('restaurant')
                            ],
                            [
                                'page' => 'menus',
                                'name' => 'Food Menu',
                                'link' => base_url('menu')
                            ]
                        ]

                    ];
                    $navigation[] = [
                        'page' => 'sport_facility',
                        'name' => 'Sports Facility',
                        'icon' => 'trophy',
                        'department_id' => '7',
                        'link' => base_url('sport_facility')
                    ];
                    $navigation[] = [
                        'page' => 'transport',
                        'name' => 'Transport',
                        'icon' => 'road',
                        'department_id' => '8',
                        'link' => base_url('transport')
                    ];
                    $navigation[] = [
                        'page' => 'events',
                        'name' => 'Events',
                        'icon' => 'book',
                        'department_id' => '9',
                        'link' => base_url('events')
                    ];

                    foreach ($navigation as $nav) {
                        if (DEPARTMENT_ID == $nav['department_id'] or USER_GROUP < 2)
                            if (isset($nav['children'])) { ?>
                                <li class="dropdown
                                <?php
                                if (($page == 'room' || $page == "room_type") and $nav['page']=='rooms_and_types') {
                                    echo 'active';
                                }
                                if (($page == 'menus' || $page == "restaurants") and $nav['page']=='restaurants_and_menus') {
                                    echo 'active';
                                }

                                ?>
                                "><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-<?php echo $nav['icon'] ?>"></i><span><?php echo $nav['name'] ?></span>
                                        <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($nav['children'] as $child) { ?>
                                            <li><a href="<?php echo $child['link'] ?>"><?php echo $child['name'] ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php
                            } else { ?>
                                <li <?php if ($page == $nav['page']) {
                                    echo 'class="active"';
                                } ?>><a href="<?php echo $nav['link'] ?>"><i
                                            class="icon-<?php echo $nav['icon'] ?>"></i><span><?php echo $nav['name'] ?></span></a>
                                </li>
                            <?php }
                    }

                    ?>
                </ul>
            </div>
            <!-- /container -->
        </div>
        <!-- /subnavbar-inner -->
    </div>
<?php } ?>
<!-- /subnavbar -->