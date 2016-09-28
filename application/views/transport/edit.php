<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <form action="" class="form-horizontal" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Vehicle Type</label>
                                    <div class="col-sm-8">
                                        <select name="type" id="" class="form-control text-center" required>
                                            <option <?php if($vehicle->type=='Bus') echo ' selected '?> value="Bus">Bus</option>
                                            <option <?php if($vehicle->type=='Car') echo ' selected '?> value="Car">Car</option>
                                            <option <?php if($vehicle->type=='Cab') echo ' selected '?> value="Cab">Cab</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Registration Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="number" required
                                               placeholder="Registration Number" value="<?php echo $vehicle->number?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Color</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="color" required
                                               placeholder="Vehicle Color" value="<?php echo $vehicle->color?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Total Seats</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="seats" required
                                               placeholder="Vehicle Seats" value="<?php echo $vehicle->seats?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Cost Per Day</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="price" required
                                               placeholder="Cost Per Day" value="<?php echo $vehicle->price?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-2 text-right">
                                        <input type="submit" class="btn btn-success" name="save" value="Save">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>