<style>
    .social{
        padding: 10px 0;
        font-size: 20px;
    }
</style>
<section id="bottom" class="wet-asphalt">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 col-sm-6">
                <div class="col-sm-12">
                    <h4>About Us</h4>
                    <p><?php echo $company['about']['about_us_short'] ?></p>
                </div>
                <div class="col-sm-12">
                    <h4>Newsletter</h4>
                    <form role="form">
                        <div class="input-group">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Enter your email">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button">Go!</button>
                            </span>
                        </div>
                    </form>

                </div>

            </div><!--/.col-md-3-->
            <div class="col-md-4 col-sm-6">
                <h4>Quick Links</h4>
                <div>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url('')?>">Home</a></li>
                        <li><a href="<?php echo base_url('')?>">Services</a></li>
                        <li><a href="<?php echo base_url('')?>">Contact</a></li>
                        <li><a href="<?php echo base_url('')?>">Privacy Policy</a></li>
                        <li><a href="<?php echo base_url('')?>">Terms of Servces</a></li>
                    </ul>
                </div>
            </div><!--/.col-md-3-->
            <div class="col-md-4 col-sm-6">
                <div class="col-sm-12">
                    <h4>Address</h4>
                    <address>
                        <strong><?php echo $company['information']['name'] ?></strong><br>
                        <?php echo $company['information']['address'] ?><br>
                        <?php echo $company['information']['city'] ?>, <?php echo $company['information']['country'] ?><br>
                        <abbr title="Phone">P:</abbr> <?php echo $company['information']['contact_one'] ?>
                    </address>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12 social">
                        <div class="col-md-4 col-sm-6 text-center">
                            <a href="<?php echo $company['social']['twitter'] ?>"><i class="icon-twitter"></i></a>

                        </div><!--/.col-md-4-->
                        <div class="col-md-4 col-sm-6 text-center">
                            <a href="<?php echo $company['social']['facebook'] ?>"><i class="icon-facebook"></i></a>

                        </div><!--/.col-md-4-->
                        <div class="col-md-4 col-sm-6 text-center">
                            <a href="<?php echo $company['social']['google'] ?>"> <i class="icon-google-plus"></i></a>

                        </div><!--/.col-md-4-->

                    </div>

                </div>
            </div> <!--/.col-md-3-->
        </div>
    </div>
</section><!--/#bottom-->

<footer id="footer" class="midnight-blue">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                &copy; 2013
                <a href="<?php echo $company['information']['website'] ?>"><?php echo $company['information']['name'] ?></a>
                All Rights Reserved.
            </div>
            <div class="col-sm-6">
                <ul class="pull-right">
                    <li><a href="<?php echo base_url('') ?>">Home</a></li>
                    <li><a href="<?php echo base_url('about') ?>">About Us</a></li>
                    <li><a href="<?php echo base_url('contact') ?>">Contact Us</a></li>
                    <li><a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a></li><!--#gototop-->
                </ul>
            </div>
        </div>
    </div>
</footer><!--/#footer-->

<script src="<?php echo base_url('assets') ?>/js/jquery.js"></script>
<script src="<?php echo base_url('assets') ?>/js/ui/jquery-ui.js"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets') ?>/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url('assets') ?>/js/main.js"></script>
<script>
    $(document).ready(function () {
        $('#checkin').datepicker({dateFormat:'yy-mm-dd'});
        $('#checkout').datepicker({dateFormat:'yy-mm-dd'});
        $('.pick_date').datepicker({dateFormat:'yy-mm-dd'});
    })
</script>
</body>
</html>