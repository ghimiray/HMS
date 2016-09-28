<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <a href="<?php echo base_url('room-type/add') ?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add
                        Room Type</a>
                    <br><br>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th> Room Type</th>
                            <th> Price</th>
                            <th> Details</th>
                            <th> Quantity</th>
                            <th class="td-actions"> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($room_types) and $room_types) :
                            foreach ($room_types as $rt) {
                                // $emp->username
                                ?>
                                <tr>
                                    <td> <?php echo $rt->room_type ?> </td>
                                    <td> <?php echo $rt->room_price ?>$</td>
                                    <td> <?php echo $rt->room_details ?> </td>
                                    <td> <?php echo $rt->room_quantity ?> </td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url()?>room-type/edit/<?php echo $rt->room_type ?>"
                                           class="btn btn-small btn-primary"><i
                                                class="btn-icon-only icon-edit"> </i></a>
                                        <a href="<?php echo base_url()?>room-type/delete/<?php echo $rt->room_type ?>"
                                           onclick="return confirm('Are you sure ?')"
                                           class="btn btn-danger btn-small"><i
                                                class="btn-icon-only icon-remove"> </i></a>
                                    </td>
                                </tr>
                            <?php }
                        else : ?>
                            <tr>
                                <td colspan="5" class="text-center"><i>No Data Available</i></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>