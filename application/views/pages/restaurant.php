<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Restaurant And Menu</h1>
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
                        <h3 class="panel-title">Restaurant and Menu</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li class="list-group-item">
                                <div class="image-wide">
                                    <img src="<?php echo base_url('assets/images/events/event-img.jpg') ?>"
                                         alt="">
                                </div>
                            </li>
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
                        Restaurants Tables Reservation
                    </h3>
                </div>

                <div class="content-body">
                    <?php
                    if ($this->session->flashdata('message')) { ?>
                        <div class="col-sm-12 text-warning"><h3><i
                                    class="icon-warning-sign"></i> <?php echo $this->session->flashdata('message') ?>
                            </h3></div>
                    <?php } ?>
                    <form class="form-inline"
                          action="<?php echo base_url('restaurant-and-menu/check') ?>">
                        <div class="panel">
                            <div class="panel-heading">
                                <h5 class="panel-title">Check Restaurant Tables</h5>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Restaurant</label>
                                    <div class="col-sm-8">
                                        <select class="form-control text-center" name="restaurant" id=""
                                                required>
                                            <option class="form-control-static" value="">
                                                -- Select --
                                            </option>
                                            <?php foreach ($restaurants as $r) : ?>
                                                <option class="form-control-static"
                                                        value="<?php echo $r->restaurant_name ?>"><?php echo $r->restaurant_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!--div class="form-group">
                                    <label for="" class="control-label col-sm-4">No. of People</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="people" value="1"
                                               required>
                                    </div>
                                </div-->
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="datepicker" name="date" class="pick_date form-control"
                                               name="date" value="<?php echo date('Y-m-d') ?>" required>
                                    </div>
                                </div>
                                <!--div class="form-group">
                                    <label for="" class="control-label col-sm-4">Time</label>
                                    <div class="col-sm-4">
                                        <select name="hour" id="" class="input-sm form-control">
                                            <option value="">HH</option>
                                            <?php for ($i = 8; $i <= 22; $i++) : ?>
                                                <option value="<?php if ($i < 10) echo '0';
                                    echo $i ?>"><?php if ($i < 10) echo '0';
                                    echo $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select name="minute" id="" class="input-sm form-control">
                                            <option value="">MM</option>
                                            <?php for ($i = 0; $i <= 59; $i += 5) : ?>
                                                <option value="<?php if ($i < 10) echo '0';
                                    echo $i ?>"><?php if ($i < 10) echo '0';
                                    echo $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div-->
                                <div class="form-group text-right">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-primary form-control"
                                               value="Find Tables">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                    <?php if (@$check) : ?>
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <h3><?php echo $filter->restaurant ?> Tables For Booking</h3>
                                    <form action="<?php echo base_url('restaurant-and-menu/book')?>" method="post" class="form-horizontal">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Date</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control pick_date" name="date" value="<?php echo $filter->date?>">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="" class="col-sm-2 control-label">Select Tables</label>
                                            <div class="col-sm-10">
                                                <?php foreach ($bookable_tables as $table) : ?>
                                                    <label class="col-sm-3 checkbox text-muted">
                                                        <input type="checkbox" name="table[<?php echo $table ?>]">
                                                        Table <?php echo $table ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12 text-right">
                                                <input type="hidden" name="restaurant" value="<?php echo $filter->restaurant?>">
                                                <input type="submit" class="btn btn-sm btn-primary" name="book" value="Book Now">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($restaurants as $restaurant) : ?>
                        <div class="panel panel-custom">
                            <div class="panel-body">
                                <h3><?php echo $restaurant->restaurant_name ?> Food Menu</h3>
                                <table>
                                    <?php if ($restaurant->menu) :foreach ($restaurant->menu as $menu) : ?>
                                        <tr>
                                            <td colspan="3">
                                                <hr>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td class="col-sm-4 text-center">
                                                <ul class="list-group panel">
                                                    <li class="list-group-item">
                                                        <img class="image-category"
                                                             src="<?php echo base_url('uploads/categories/' . $menu->image) ?>"
                                                             alt="">
                                                        <br>
                                                        <h4><?php echo $menu->name ?></h4>
                                                        <p>
                                                            <?php echo $menu->description ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="col-sm-2"></td>
                                            <td class="col-sm-6">
                                                <?php if ($menu->items) : foreach ($menu->items as $count => $item) : ?>
                                                    <div class="panel">
                                                        <ul class="list-inline list-group bg-warning">
                                                            <li style="width: 25%">
                                                                <img class="image-item"
                                                                     src="<?php echo base_url('uploads/items/' . $item->image) ?>"
                                                                     alt="">
                                                            </li>
                                                            <li style="width: 74%">
                                                                <strong><?php echo $item->name ?></strong>
                                                                <br>
                                                                <p><?php echo $item->description ?></p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php endforeach;

                                                endif; ?>
                                            </td>
                                        </tr>

                                    <?php endforeach;

                                    else : ?>

                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</section><!--/#title-->
