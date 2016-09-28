<!DOCTYPE html>
<html>
<head>
    <title>Login : Hotel Management System</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
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
        </div>
        <!-- /container -->
    </div>
    <!-- /navbar-inner -->
</div>

<div class="account-container">

    <div class="content clearfix">

        <form action="<?php echo base_url('login') ?>" method="post">

            <h1>Member Login</h1>

            <div class="login-fields">
                <?php
                if (@$error) {
                    ?>
                    <div class="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Your username or password are invalid
                    </div>
                <?php }
                if ($this->session->flashdata('message')) {
                    echo "<p>" . $this->session->flashdata('message') . "</p>";
                } else echo "<p>Please provide your details</p>";
                ?>


                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" id="username" autocomplete="off" required name="username" value=""
                           placeholder="Username" class="login username-field"/>
                </div> <!-- /field -->

                <div class="field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" autocomplete="off" required name="password" value=""
                           placeholder="Password" class="login password-field"/>
                </div> <!-- /password -->

            </div> <!-- /login-fields -->

            <div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="remember" type="checkbox" class="field login-checkbox" value="Yes"
                           tabindex="4"/>
					<label class="choice" for="Field">Keep me signed in</label>
				</span>

                <button class="button btn btn-success btn-large">Sign In</button>

            </div> <!-- .actions -->


        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->


<div class="login-extra">
    <a href="/forget">Reset Password</a>
</div> <!-- /login-extra -->
<div class="footer">
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="span12"> &copy; 2016 <a href="http://kathmanduhotel.com">Kathmandu Hotel</a>.
                    <span class="pull-right"></span></div>
                <!-- /span12 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /footer-inner -->
</div>
<!-- /footer -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery-1.7.2.min.js"></script>
<script src="/js/excanvas.min.js"></script>
<script src="/js/chart.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="/js/full-calendar/fullcalendar.min.js"></script>

<script src="/js/base.js"></script>

</body>
</html>