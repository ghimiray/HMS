<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Reservation</h1>
            </div>
        </div>
    </div>
</section><!--/#title-->
<section id="contact-page" class="container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            My Room Reservation Checkout
                        </h3>
                    </div>
                    <div class="panel-body">
                        <?php if ($reserved_rooms) : ?>
                            <table class="table table-responsive table-">
                                <tr>
                                    <th>Room Type</th>
                                    <th>CheckIn Date</th>
                                    <th>CheckOut Date</th>
                                    <th>Total Days</th>
                                    <th>Room Price Per Day</th>
                                    <th>Reservation Price</th>
                                </tr>
                                <?php foreach ($reserved_rooms as $room_id => $room) : $room = is_array($room) ? (object)$room : $room;
                                    if (!is_object($room)) continue;
                                    ?>
                                    <tr>
                                        <td><?php echo $room->room_type ?></td>
                                        <td><?php echo $room->checkin ?></td>
                                        <td><?php echo $room->checkout ?></td>
                                        <td><?php echo $room->no_of_days ?></td>
                                        <td><?php echo $room->room_price ?></td>
                                        <td><?php echo $room->total_price ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th class="text-right" colspan="5">Total Cost</th>
                                    <th><?php echo $reserved_rooms['grand_total'] ?></th>
                                </tr>
                            </table>
                        <?php else : ?>

                        <?php endif; ?>
                    </div>
                    <div class="panel-footer text-right">
                        <?php
                        if ($this->session->flashdata('payment') == 'success') { ?>
                            <div class="col-sm-12 text-center">
                                <h4>Your payment and reservation are successful. Please goto your <a
                                        href="<?php echo base_url('my-account') ?>">Account</a> to verify.</h4>
                            </div>
                        <?php } elseif ($this->session->flashdata('payment') == 'fail') { ?>
                            <div class="col-sm-12 text-center">
                                <h3>An error was faced while making payment. Please try again.</h3>
                            </div>
                        <?php }
                        if ($this->session->flashdata('payment') != 'success') : ?>

                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal">

                                <input type="hidden" name="cmd" value="_xclick" />
                                <input type="hidden" name="cbt" value="Return to example" />
                                <input type="hidden" name="business" value="email" />
                                <input type="hidden" name="item_name" value="example Purchase" />
                                <input type="hidden" name="amount" value="9.99">
                                <input type="hidden" name="button_subtype" value="services" />
                                <input type="hidden" name="no_shipping" value="1">
                                <input type="hidden" name="return" value="URL" />
                                <input type="hidden" name="notify_url" value="URL"/>
                                <input type="hidden" name="cancel_return" value="URL" />
                                <input type="hidden" name="image_url" value="" />
                                <input type="hidden" class="btn btn-primary" style="width:100%" alt="PayPal - The safer, easier way to pay online!"/>

                            </form>

                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                <input type="hidden" name="cmd" value="_xclick" />
                                <input type="hidden" name="cbt" value="Return To Kathmandu Hotel" />
                                <input type="hidden" name="business" value="ox1234ford@gmail.com">
                                <input type="hidden" name="item_name" value="Kathmandu Hotel Room Reservation">
                                <input type="hidden" name="amount" value="<?php echo $reserved_rooms['grand_total'] ?>">
                                <input type="hidden" name="button_subtype" value="services" />
                                <input type="hidden" name="no_shipping" value="1">
                                <input type="hidden" name="currency_code" value="USD"/>
                                <input type="hidden" id="custom" name="custom" value="invoice_id to track"/>
                                <input type="hidden" name="return"
                                       value="<?php echo base_url('rooms-and-reservations/process/success') ?>">
                                <input type="hidden" name="cancel_return"
                                       value="<?php echo base_url('rooms-and-reservations/process/cancel') ?>">
                                <input type="hidden" name="notify_url"
                                       value="<?php echo base_url('rooms-and-reservations/process/notify') ?>">
                                <input type="image"
                                       src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/gold-rect-paypalcheckout-60px.png"
                                       border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

