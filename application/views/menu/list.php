<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th> Restuarant name</th>
                            <th> Restuarant Detail</th>
                            <th> Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($restaurants)
                            foreach ($restaurants as $rest) {
                                // $emp->username
                                ?>
                                <tr>
                                    <td> <?php echo $rest->restaurant_name ?> </td>
                                    <td> <?php echo $rest->restaurant_details ?> </td>
                                    <td style="width:150px;text-align: center">
                                        <a
                                            href="<?php echo base_url('menu/view/' . strtolower(str_replace(' ','-',$rest->restaurant_name))) ?>"
                                            class="btn btn-small btn-primary"><i
                                                class="btn-icon-only icon-eye-open"> </i> View</a>
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