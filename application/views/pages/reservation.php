<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Rooms and Reservations</h1>
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
                        <h3 class="panel-title">Rooms Reservation</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li class="list-group-item">
                                <div class="image-wide">
                                    <img src="<?php echo base_url('assets/images/events/event-img.jpg') ?>"
                                         alt="">
                                </div>
                            </li>
                            <?php foreach ($rooms as $room) : ?>
                                <li class="list-group-item">
                                    <i class="icon-star"> </i> <?php echo $room->room_type ?>
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
            <div class="col-sm-6 center-content">
                <div class="content-header">
                    <h3 class="content-title">
                        Kathmandu Hotel Rooms Reservation
                    </h3>
                    <hr>
                </div>
                <div class="content-body">
                    <?php
                    if ($this->session->flashdata('message')) { ?>
                        <div class="col-sm-12 text-warning"><h3><i
                                    class="icon-warning-sign"></i> <?php echo $this->session->flashdata('message') ?>
                            </h3></div>
                    <?php }
                    if ($check) : ?>
                        <div class="col-sm-12">
                            Following Rooms are available. Please Select and
                            continue
                            your reservation
                            <ul class="list-inline ">
                                <li class="list-unstyled" style="line-height: 35px">
                                    Room type : <span
                                        class="label label-primary"><?php echo $filter['room_type'] ?></span>
                                    Check In Date : <span
                                        class="label label-primary"><?php echo $filter['checkin'] ?></span>
                                    Checkout Date : <span
                                        class="label label-primary"><?php echo $filter['checkout'] ?></li>
                                </span>
                            </ul>
                            <?php if (!empty($bookable_rooms)) : ?>
                                <form action="<?php echo base_url('rooms-and-reservations/checkout') ?>"
                                      class="form-horizontal" role="form" method="post">
                                    <table class="table text-center">
                                        <tr>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>Type</th>
                                            <th>Number</th>
                                            <th>Cost</th>
                                            <th>Checkin</th>
                                            <th>Checkout</th>
                                        </tr>
                                        <?php foreach ($bookable_rooms as $br) : ?>
                                            <tr>
                                                <td><input class="input-sm" type="checkbox"
                                                           name="room[<?php echo $br->room_id ?>]">
                                                </td>
                                                <td><?php echo $br->room_type ?></td>
                                                <td><?php echo $br->room_id ?></td>
                                                <td><?php echo $br->room_price ?></td>
                                                <td><input type="text" class="input-sm form-control pick_date"
                                                           name="checkin[<?php echo $br->room_id ?>]"
                                                           value="<?php echo $filter['checkin'] ?>"></td>
                                                <td><input type="text" class="input-sm form-control pick_date"
                                                           name="checkout[<?php echo $br->room_id ?>]"
                                                           value="<?php echo $filter['checkout'] ?>"></td>
                                            </tr>

                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="6">
                                                <div class="col-sm-12">
                                                    <div class="form-group text-right">
                                                        <button class="btn btn-primary" type="submit">Reserve Now
                                                            !
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </form>
                            <?php else : ?>
                                <table class="table table-hover">
                                    <tr>
                                        <th colspan="">Sorry, There are no rooms available for reservation. Please
                                            modify your criteria.
                                        </th>
                                    </tr>

                                </table>
                            <?php endif ?>

                        </div>
                    <?php endif; ?>

                    <?php foreach ($rooms as $room) : ?>
                        <div class=" panel panel-custom">
                            <div class="panel-body">
                                <ul class="list-group">

                                    <li class="list-unstyled"><h4><?php echo $room->room_type ?></h4>
                                    <li class="list-group-item list-group-item-heading">Cost per Night : <span
                                            class="label label-primary">$ <?php echo $room->room_price ?>
                                            Only</span></li>
                                    <li class="list-group-item list-group-item-heading">Total Rooms : <span
                                            class="label label-success"><?php
                                            $numbers = count(explode(',', $room->rooms->rooms));
                                            echo $numbers
                                            ?> Rooms Available</span></li>
                                    <li class="list-group-item list-group-item-heading"><a
                                            class="btn btn-success form-control" href="">Book Now !</a></li>
                                </ul>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
            <div class="col-sm-3 sidebar sidebar-right">
                <form class="form-horizontal"
                      action="<?php echo base_url('rooms-and-reservations/check') ?>">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h5 class="panel-title">Check Rooms Availability</h5>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="" class="col-sm-5 control-label">Room Type</label>
                                <div class="col-sm-7">
                                    <select class="form-control text-center" name="room_type" id=""
                                            required>
                                        <option class="form-control-static" value="">-- Select -- </option>
                                        <?php foreach ($rooms as $type) : ?>
                                            <option class="form-control-static"
                                                    value="<?php echo $type->room_type ?>"><?php echo $type->room_type ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-sm-5">Check In </label>
                                <div class="col-sm-7">
                                    <input type="text" id="checkin" class="form-control" name="checkin"
                                           value="<?php echo date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-sm-5">Check Out </label>
                                <div class="col-sm-7">
                                    <input type="text" id="checkout" class="form-control" name="checkout"
                                           value="<?php $date = new DateTime('tomorrow');
                                           echo date_format($date, 'Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-primary form-control"
                                           value="Find Rooms">
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer image-wide">
                            <img src="<?php echo base_url('assets/images/ads/paypal.png') ?>" alt="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section><!--/#title-->
