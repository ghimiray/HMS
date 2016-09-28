<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Transportation Service</h1>
                <p></p>
            </div>
        </div>
    </div>
</section><!--/#title-->
<section id="title" class="content-section">
    <div class="container">
        <div class="row main-content">

            <div class="col-sm-3 sidebar sidebar-left">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Transport Booking</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li class="list-group-item">
                                <div class="image-wide">
                                    <img src="<?php echo base_url('assets/images/events/event-img.jpg') ?>"
                                         alt="">
                                </div>
                            </li>
                            <?php foreach ($types as $transport) : ?>
                                <li class="list-group-item">
                                    <i class="icon-star"> </i> <?php echo $transport->type ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Our Other Services</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li class="list-group-item">
                                <a href="<?php echo base_url('restaurant-and-menu') ?>"><i
                                        class="icon-adjust"></i> Restaurant</a>
                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo base_url('rooms-and-reservations') ?>"><i
                                        class="icon-adjust"></i> Rooms and Reservation</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url('transportation-service') ?>"><i
                                        class="icon-adjust"></i> Transportation</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url('vehicle-parking') ?>"><i class="icon-adjust"></i>
                                    Parking</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url('gym-and-fitness') ?>"><i class="icon-adjust"></i>
                                    Gym
                                    and Fitness</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url('laundry-service') ?>"><i class="icon-adjust"></i>
                                    Laundry</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 center-content">
                <div class="content-header">
                    <h3 class="content-title">
                        Transportation Checkout
                    </h3>
                    <hr>
                </div>
                <div class="content-body">
                    <div class="panel">
                        <div class="panel-body">
                            <form
                                action="<?php echo base_url('transportation-service/checkout') ?>"
                                method="post">

                                <table class="table table-striped text-center">
                                    <tr>
                                        <th class="text-center">SN</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Number</th>
                                        <th class="text-center">Color</th>
                                        <th class="text-center">Start</th>
                                        <th class="text-center">End</th>
                                        <th class="text-center">Pickup</th>
                                        <th class="text-center">Destination</th>

                                    </tr>
                                    <?php if ($transports) : $count = 1; ?>

                                        <?php foreach ($transports as $id => $detail) : $detail = (array)$detail ?>
                                            <tr>
                                                <td><?php echo $count ?></td>
                                                <td><?php echo @$detail['detail']->type ?></td>
                                                <td><?php echo @$detail['detail']->number ?></td>
                                                <td><?php echo @$detail['detail']->color ?></td>
                                                <td><?php echo @$detail['start'] ?></td>
                                                <td><?php echo @$detail['end'] ?></td>
                                                <td><input type="text" class="form-control input-sm"
                                                           placeholder="Pickup Place"
                                                           name="pickup[<?php echo $detail['detail']->id ?>]" required>
                                                </td>
                                                <td><input type="text" class="form-control input-sm"
                                                           placeholder="Destination"
                                                           name="destination[<?php echo $detail['detail']->id ?>]"
                                                           required>
                                                </td>
                                            </tr>
                                            <?php $count++; endforeach; ?>
                                        <tr>
                                            <td colspan="8" class="text-right">
                                                <input type="submit" class="btn btn-primary" name="confirm_book"
                                                       value="Confirm Booking">
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#title-->
