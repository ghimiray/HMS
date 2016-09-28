<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Restaurant Table Booking</h1>
            </div>
        </div>
    </div>
</section><!--/#title-->
<section id="title" class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php
                if (!empty($restaurant)) { ?>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Restaurant Table Booking</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <h5>Booking date : <span class="label label-primary"><?php echo $restaurant['date'] ?></span></h5>
                                <br>
                            </div>
                            <div class="col-sm-12">
                                <table class="table table-striped text-center">
                                    <tr>
                                        <th class="text-center">SN</th>
                                        <th class="text-center">Restaurant</th>
                                        <th class="text-center">Table No</th>
                                    </tr>
                                    <?php if ($restaurant['tables']) : ?>

                                        <?php foreach ($restaurant['tables'] as $count => $table) : ?>
                                            <tr>
                                                <td><?php echo $count + 1 ?></td>
                                                <td><?php echo @$restaurant['name'] ?></td>
                                                <td>Table No. <?php echo $table ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <form
                                                    action="<?php echo base_url('restaurant-and-menu/book/confirm') ?>"
                                                    method="post">
                                                    <input type="submit" class="btn btn-primary" name="confirm_book"
                                                           value="Confirm Booking">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('r_b_c')) : ?>
                    <div class="panel panel-success" style="margin: 25px 0">
                        <div class="panel-heading text-center">
                            <h3 class="panel-title">
                                Restaurant Table Booking
                            </h3>
                        </div>
                        <div class="panel-body text-center" style="margin: 25px 0">
                            <h4><i class="icon-info-sign"></i> Your table booking was Successful!! Thankyou for making
                                business with us. Please check your <a href="<?php echo base_url('my-account')?>">Account</a>.</h4>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><!--/#title-->
