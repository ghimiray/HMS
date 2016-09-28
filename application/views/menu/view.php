<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th colspan="2"> <?php echo $restaurant->restaurant_name ?></th>
                            <th class="text-right"><a
                                    href="<?php echo base_url('menu/addcategory/' . strtolower(str_replace(' ', '-', $restaurant->restaurant_name))) ?>"
                                    class="btn btn-sm btn-primary">
                                    <i class="icon-plus-sign"></i> Add New Category
                                </a>
                            </th>
                        </tr>
                        <?php
                        if ($menu) : ?>
                            <tr>
                                <th colspan="2">Category</th>
                                <th colspan="1">Items</th>
                            </tr>

                            <?php foreach ($menu as $cat) : ?>
                                <tr>
                                    <td>
                                        <img src="
                                        <?php echo $cat->image ? base_url('uploads/categories/' . $cat->image) : base_url('uploads/categories/no-image.jpg') ?>"
                                             class="image-category" alt="">
                                    </td>
                                    <td>
                                        <strong><?php echo $cat->name ?></strong>
                                        <p><?php echo $cat->description ?></p>
                                        <hr>
                                        <ul class="list-inline">
                                            <li>
                                                <a title="Edit Category"
                                                    href="<?php echo base_url('menu/editcategory/' . $cat->id) ?>"
                                                    class="btn btn-xs btn-inverse">
                                                    <i class="icon-edit-sign"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Delete Category"
                                                    href="<?php echo base_url('menu/deletecategory/' . $cat->id) ?>"
                                                    class="btn btn-xs btn-inverse" onclick="return confirm('Are you sure ? All Items will also be deleted.')">
                                                    <i class="icon-remove"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        <hr>
                                        <a
                                            href="<?php echo base_url('menu/additem/' . $cat->id) ?>"
                                            class="btn btn-xs btn-success">
                                            <i class="icon-plus-sign"></i> Add New Item
                                        </a>
                                    </td>
                                    <?php
                                    if (!empty($cat->items)) : ?>
                                        <td>
                                            <ul class="list-group">
                                                <?php foreach ($cat->items as $item): ?>
                                                    <li class="list-group-item">
                                                        <ul class="list-inline">
                                                            <li style="width: 30%">
                                                                <img
                                                                    src="<?php echo $item->image ? base_url('uploads/items/' . $item->image) : base_url('uploads/items/no-image.jpg') ?>"
                                                                    class="image-item" alt="">
                                                            </li>
                                                            <li style="width: 40%">
                                                                <strong><?php echo $item->name ?></strong>
                                                                <p><?php echo $item->description ?></p>
                                                            </li>
                                                            <li>
                                                                <a title="Edit Item"
                                                                    href="<?php echo base_url('menu/edititem/' . $item->id) ?>"
                                                                    class="btn btn-xs btn-inverse">
                                                                    <i class="icon-edit-sign"></i>
                                                                </a>

                                                            </li>
                                                            <li>
                                                                <a title="Remove Item"
                                                                    href="<?php echo base_url('menu/deleteitem/' . $item->id) ?>"
                                                                    class="btn btn-xs btn-inverse" onclick="return confirm('Are you sure ?')">
                                                                    <i class="icon-remove"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <?php
                                    else : ?>
                                        <td><i class="icon-info-sign"></i> There are no menus under this
                                            category.
                                        </td>
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <th><i class="icon-info-sign"></i> There are no categories and menus under this
                                    restaurant.
                                </th>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>