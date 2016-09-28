<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <a href="<?php echo base_url('transport/add') ?>" class="btn btn-small btn-success"><i
                            class="btn-icon-only icon-plus"></i>Add New Vehicle</a>

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th> Type</th>
                            <th> Number</th>
                            <th> Color</th>
                            <th> Total Seats</th>
                            <th> Cost Per Day</th>
                            <th> Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($vehicles)
                            foreach ($vehicles as $veh) {
                                // $emp->username
                                ?>
                                <tr>
                                    <td> <?php echo $veh->type ?> </td>
                                    <td> <?php echo $veh->number ?> </td>
                                    <td> <?php echo $veh->color ?> </td>
                                    <td> <?php echo $veh->seats ?> </td>
                                    <td> <?php echo $veh->price ?> </td>
                                    <td style="width:150px;text-align: center">
                                        <ul class="list-inline">
                                            <li>
                                                <a title="Edit Vehicle"
                                                   href="<?php echo base_url('transport/edit/' . $veh->id) ?>"
                                                   class="btn btn-xs btn-inverse">
                                                    <i class="icon-edit-sign"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Delete Vehicle"
                                                   href="<?php echo base_url('transport/delete/' . $veh->id) ?>"
                                                   class="btn btn-xs btn-inverse" onclick="return confirm('Are you sure ?')">
                                                    <i class="icon-remove"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php } else { ?>
                            <tr>
                                <td colspan="6"><i class="fa fa-info-o"></i><i>No Data Available</i></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>