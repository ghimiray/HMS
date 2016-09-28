<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <a href="<?php echo base_url() ?>employee/add" class="btn btn-small btn-primary"><i
                            class="btn-icon-only icon-ok"></i>Add
                        Employee</a>
                    <br><br>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th> Fullname</th>
                            <th> Username</th>
                            <th> Department</th>
                            <th> Job</th>
                            <th> Email</th>
                            <th class="td-actions"> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($employees) and is_array($employees)) {
                            foreach ($employees as $emp) {
                                // $emp->username
                                ?>
                                <tr>
                                    <td> <?php echo $emp->employee_firstname . " " . $emp->employee_lastname ?> </td>
                                    <td> <?php echo $emp->employee_username ?> </td>
                                    <td> <?php echo $emp->department_name ?> </td>
                                    <td> <?php echo $emp->employee_type ?> </td>
                                    <td> <?php echo $emp->employee_email ?> </td>
                                    <td class="td-actions"><a href="<?php echo base_url() ?>employee/edit/<?php echo $emp->employee_id ?>"
                                                              class="btn btn-small btn-primary"><i
                                                class="btn-icon-only icon-edit"> </i></a> | <a
                                            href="<?php echo base_url() ?>employee/delete/<?php echo $emp->employee_id ?>"
                                            onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i
                                                class="btn-icon-only icon-remove"> </i></a></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6" class="text-center"><i>There are no employees in the system. Please
                                        create them.</i></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>