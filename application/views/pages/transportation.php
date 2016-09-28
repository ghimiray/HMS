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
                        Transportation Booking
                    </h3>
                    <hr>
                </div>
                <div class="content-body">

                    <?php
                    if ($this->session->flashdata('message')) { ?>
                        <div class="col-sm-12 text-warning"><h3>
                                <?php if (!$this->session->flashdata('message')) : ?>
                                    <i class="icon-warning-sign"></i>
                                <?php endif; ?>
                                <?php echo $this->session->flashdata('message') ?>
                            </h3></div>
                    <?php } ?>
                    <div class="col-sm-12">
                        <form class="form-inline" role="form"
                              action="<?php echo base_url('transportation-service/check') ?>">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Check Vehicle Availability</h5>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-imline">

                                        <li class="form-group">
                                            <label for="" class="">Type</label>
                                            <select class="input-sm text-center" name="type" id=""
                                                    required>
                                                <option class="form-control-static" value="">-- Select --</option>
                                                <?php foreach ($types as $type) : ?>
                                                    <option class="form-control-static"
                                                            value="<?php echo $type->type ?>"><?php echo $type->type ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </li>
                                        <li class="form-group">
                                            <label for="" class="">Start </label>
                                            <input type="text" id="checkin" class="input-sm" name="start"
                                                   value="<?php echo date('Y-m-d') ?>" required>
                                        </li>
                                        <li class="form-group">
                                            <label for="">End </label>
                                            <input type="text" id="checkout" class="input-sm" name="end"
                                                   value="<?php $date = new DateTime('tomorrow');
                                                   echo date_format($date, 'Y-m-d') ?>" required>
                                        </li>
                                        <li class="form-group">
                                            <input type="submit" class="btn btn-sm btn-primary "
                                                   value="Find Vehicles">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if ($check) : ?>
                        <div class="col-sm-12">
                            Following Vehickes are available. Please Select and
                            continue
                            your booking
                            <ul class="list-inline ">
                                <li class="list-unstyled" style="line-height: 35px">
                                    Vehicle type : <span
                                        class="label label-primary"><?php echo $filter['type'] ?></span>
                                    Start Date : <span
                                        class="label label-primary"><?php echo $filter['start'] ?></span>
                                    End Date : <span
                                        class="label label-primary"><?php echo $filter['end'] ?></li>
                                </span>
                            </ul>
                            <?php if (!empty($bookable_vehicles)) : ?>
                                <form action="<?php echo base_url('transportation-service/checkout') ?>"
                                      class="form-horizontal" role="form" method="post">
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <td></td>
                                            <td>Type</td>
                                            <td>Number</td>
                                            <td>Color</td>
                                            <td>Seats</td>
                                            <td>Cost/Day</td>
                                            <td>Start</td>
                                            <td>End</td>
                                        </tr>
                                        <?php foreach ($bookable_vehicles as $br) : ?>
                                            <tr>
                                                <td><input class="input-sm" type="checkbox"
                                                           name="vehicle[<?php echo $br->id ?>]">
                                                </td>
                                                <td><?php echo $br->type ?></td>
                                                <td><?php echo $br->number ?></td>
                                                <td><?php echo $br->color ?></td>
                                                <td><?php echo $br->seats ?></td>
                                                <td><?php echo $br->price ?></td>
                                                <td><input type="text" class="input-sm form-control pick_date"
                                                           name="start[<?php echo $br->id ?>]"
                                                           value="<?php echo $filter['start'] ?>"></td>
                                                <td><input type="text" class="input-sm form-control pick_date"
                                                           name="end[<?php echo $br->id ?>]"
                                                           value="<?php echo $filter['end'] ?>"></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="8">
                                                <div class="col-sm-12">
                                                    <div class="form-group text-right">
                                                        <input type="submit" name="checkout" value="Book Now !"
                                                               class="btn btn-primary">
                                                        </input>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </form>
                            <?php else : ?>
                                <table class="table table-hover">
                                    <tr>
                                        <th colspan="">Sorry, There are no vehicles available for reservation. Please
                                            modify your criteria.
                                        </th>
                                    </tr>

                                </table>
                            <?php endif ?>

                        </div>
                    <?php endif; ?>
                    <h3 class="content-title">
                        Our Vehicles in Service
                    </h3>


                    <?php foreach ($transports as $tra) : ?>
                        <div class=" panel panel-custom">
                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-unstyled"><h4><?php echo $tra->type ?></h4>
                                    <li class="list-group-item list-group-item-heading">Vehicle Number : <span
                                            class="label label-primary"><?php echo $tra->number ?>
                                            </span></li>
                                    <li class="list-group-item list-group-item-heading">Vehicle Color : <span
                                            class="label label-primary"><?php echo $tra->color ?>
                                            </span></li>
                                    <li class="list-group-item list-group-item-heading">Cost per Day : <span
                                            class="label label-primary">$ <?php echo $tra->price ?>
                                            </span></li>
                                    <li class="list-group-item list-group-item-heading">Total Seats : <span
                                            class="label label-success"><?php
                                            $numbers = $tra->seats;
                                            echo $numbers
                                            ?> Seats</span></li>
                                </ul>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section><!--/#title-->
