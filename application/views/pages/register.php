<style>
    .form-group {
        padding: 15px 0;
    }
</style>
<?php
if (!isset($_postdata)) $_postdata = array();

?>
<section class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Create New Account</h2>
            </div>
        </div>
    </div>
</section>
<section class="">
    <div class="container">
        <form action="" class="form" role="form" method="post">
            <div class="row">
                <?php
                if ($this->session->userdata('reservation')) : ?>
                    <div class="col-sm-8 col-sm-offset-2">
                        <table class="table table-responsive">
                            <tr>
                                <th colspan="">To complete the following reservation, please register with your detail.</th>
                            </tr>
                        </table>

                    </div>
                <?php endif; ?>

                <div class="col-sm-8 col-sm-offset-2">
                    <div class="col-sm-12">
                        <?php if (!empty($_postdata)) : ?>
                            <div class="bg-warning text-center text-warning">
                                Your Passwords didn't match. Please retype the passwords.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="fname" class="col-sm-4 control-label">First Name</label>
                            <div class="col-sm-8">
                                <input value="<?php echo @$_postdata['fname'] ?>" type="text" id="fname" name="fname"
                                       placeholder="First Name"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="lname" class="col-sm-4 control-label">Last Name</label>
                            <div class="col-sm-8">
                                <input value="<?php echo @$_postdata['lname'] ?>" type="text" id="lname" name="lname"
                                       placeholder="Last Name"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">E-mail</label>
                            <div class="col-sm-8">
                                <input value="<?php echo @$_postdata['email'] ?>" type="email" id="email" name="email"
                                       placeholder="E-mail"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="contact" class="col-sm-4 control-label">Contact Number</label>
                            <div class="col-sm-8">
                                <input value="<?php echo @$_postdata['contact'] ?>" type="text" id="contact"
                                       name="contact" placeholder="Contact Number"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="address" class="col-sm-4 control-label">Address</label>
                            <div class="col-sm-8">
                                <input value="<?php echo @$_postdata['address'] ?>" type="text" id="address"
                                       name="address" placeholder="Contact Address"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="country" class="col-sm-4 control-label">Country</label>
                            <div class="col-sm-8">
                                <select name="country" id="country" class="form-control" required>
                                    <option value="">----- Select Country -----</option>
                                    <?php
                                    foreach (@$countries as $country) {
                                        ?>
                                        <option
                                            <?php
                                            if (!empty($_postdata) and @$_postdata['country']) {
                                                if (@$_postdata['country'] == $country->country_code)
                                                    echo " selected ";
                                            }
                                            ?>
                                            value="<?php echo $country->country_code ?>"><?php echo $country->country_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" id="password" name="password" placeholder="Password"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="password_re" class="col-sm-4 control-label">Retype Password</label>
                            <div class="col-sm-8">
                                <input type="password" id="password_re" name="password_re" placeholder="Retype Pasword"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="col-sm-6 text-center">
                        <input type="submit" class="btn btn-primary" name="register" value="Create Account">
                    </div>
                    <div class="col-sm-6 text-center">
                        <a href="<?php echo base_url() ?>" class="btn btn-warning">Cancel and Return Home</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>