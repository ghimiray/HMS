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
                <li class="list-group-item active"><a href="<?php echo base_url('my-account/restaurant') ?>"><i
                            class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Restaurant</a></li>
                <li class="list-group-item"><a href="<?php echo base_url('my-account/transport') ?>"><i
                            class="icon-dashboard"></i>&nbsp;&nbsp;&nbsp;Transport</a></li>
            </ul>
        </div>

        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">My Restaurant Table Reservation</h3>

                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Restaurant Name</th>
                            <th>Table Number</th>
                            <th>Checkin Date</th>
                        </tr>

                        <?php if ($data) :
                            foreach ($data as $d) :
                                ?>
                                <tr>
                                    <td><?php echo $d->restaurant_name ?></td>
                                    <td><?php echo $d->table_number ?></td>
                                    <td><?php echo $d->book_date ?></td>
                                </tr>

                            <?php endforeach;;
                        else : ?>
                            <tr>
                                <td colspan="3"><i class="icon-info-sign"></i> You haven't made any Tables Reservations
                                    yet.
                                </td>
                            </tr>

                        <?php endif; ?>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>

