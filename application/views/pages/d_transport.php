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
                <li class="list-group-item"><a href="<?php echo base_url('my-account') ?>"><i
                            class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Dashboard</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('my-account/profile') ?>"><i
                            class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;My Profile</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('my-account/reservation') ?>"><i
                            class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Reservation</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('my-account/restaurant') ?>"><i
                            class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Restaurant</a></li>
                <li class="list-group-item active"><a href="<?php echo base_url('my-account/transport') ?>"><i
                            class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Transport</a></li>
            </ul>
        </div>

        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">My Transport Booking</h3>

                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Vehicle Type</th>
                            <th>Vehicle Number</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Pickup Location</th>
                            <th>Destination</th>
                        </tr>

                        <?php if ($data) :
                            foreach ($data as $d) :
                                ?>
                                <tr>
                                    <td><?php echo $d->detail->type ?></td>
                                    <td><?php echo $d->detail->number ?></td>
                                    <td><?php echo $d->start_date ?></td>
                                    <td><?php echo $d->end_date ?></td>
                                    <td><?php echo $d->pickup ?></td>
                                    <td><?php echo $d->dropping ?></td>
                                </tr>

                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="6"><i class="icon-info-sign"></i> You haven't made any Transport Bookings yet.</td>
                            </tr>

                        <?php endif; ?>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>

