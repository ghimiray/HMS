<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>My Account</h1>
            </div>
        </div>
    </div>
</section><!--/#title-->
<section id="contact-page" class="container">
    <div class="row">
        <div class="col-sm-3 account-nav">
            <ul class="list-group panel-custom">
                <li class="list-group-item active"><a href="<?php echo base_url('my-account')?>"><i class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Dashboard</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('my-account/profile')?>"><i class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;My Profile</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('my-account/reservation')?>"><i class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Reservation</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('my-account/restaurant')?>"><i class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Restaurant</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('my-account/transport')?>"><i class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Transport</a></li>
            </ul>
        </div>
        
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">My Reservations</h3>

                </div>
                <div class="panel-body">
                    Total <?php echo count($reservation)?> Reservations.

                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">My Restaurant Bookings</h3>
                </div>
                <div class="panel-body">
                    Total <?php echo count($restaurant)?> Restaurant Bookings.

                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">My Transport Bookings</h3>

                </div>
                <div class="panel-body">
                    Total <?php echo count($transport)?> Transport Bookings.
                </div>
            </div>
        </div>
    </div>
</section>

