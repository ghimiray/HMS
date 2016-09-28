<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <a href="<?php echo base_url('room/add')?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Rooms</a>
                    <br><br>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th> Room Type</th>
                            <th> Min ID</th>
                            <th> Max ID</th>
                            <th> Quantity</th>
                            <th class="td-actions"> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($rooms) and $rooms) :
                            foreach ($rooms as $rm) {
                                // $emp->username
                                ?>
                                <tr>
                                    <td> <?php echo $rm->room_type ?> </td>
                                    <td> <?php echo $rm->min_id ?> </td>
                                    <td> <?php echo $rm->max_id ?> </td>
                                    <td> <?php echo($rm->max_id - $rm->min_id + 1) ?> </td>
                                    <td class="td-actions">
                                        <a href="<?php echo base_url()?>room/edit/<?php echo $rm->room_type ?>/<?php echo $rm->min_id ?>/<?php echo $rm->max_id ?>"
                                           class="btn btn-small btn-primary"><i
                                                class="btn-icon-only icon-edit"> </i></a>
                                        <a href="<?php echo base_url()?>room/delete/<?php echo $rm->min_id ?>/<?php echo $rm->max_id ?>"
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