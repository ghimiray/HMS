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
                                            <option value="">-- Select Type --</option>
                                            <option value="Bus">Bus</option>
                                            <option value="Bus">Car</option>
                                            <option value="Bus">Cab</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Registration Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="number" required
                                               placeholder="Registration Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Color</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="color" required
                                               placeholder="Vehicle Color">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Total Seats</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="seats" required
                                               placeholder="Vehicle Seats">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Cost Per Day</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="price" required
                                               placeholder="Cost Per Day">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-2 text-right">
                                        <input type="submit" class="btn btn-success" name="create" value="Add">
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