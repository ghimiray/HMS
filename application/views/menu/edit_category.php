<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <form action="" class="form-horizontal" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Restaurant Name</label>
                                    <div class="col-sm-8">
                                        <select name="restaurant" id="" class="form-control text-center" required>
                                            <option value="<?php echo $category->restaurant_name?>"><?php echo $category->restaurant_name?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Category Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name" required
                                               placeholder="Category Name" value="<?php echo $category->name?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <label for="" class="control-label col-sm-4">Image</label>
                                    <div class="col-sm-8">
                                        <img src="<?php echo $category->image ? base_url('uploads/categories/'.$category->image) : base_url('uploads/categories/no-image.jpg')?>" alt="">
                                        <input name="image" type="file" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Description</label>
                                    <div class="col-sm-8">
                                        <textarea name="description" id="" class="form-control" rows="10"
                                                  placeholder="Category Description"><?php echo $category->description?></textarea>
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