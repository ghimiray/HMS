<style>
    .custom-modal {
        background: #FFF;
        margin: 10px;
    }

    .form-group {
        border-bottom: 1px solid #efefef;
    }
</style>
<div class="container" style="margin: 0 auto;">
    <div class="row">
        <form action="" method="post">
            <div class="col-xs-12">
                <?php
                foreach ($fillables as $type => $data) : ?>
                    <div class="custom-modal">
                        <div class="modal-header">
                            <h5 class="panel-title">
                                <?php echo ucwords(str_replace("_", " ", $type)) ?>
                            </h5>
                        </div>
                        <div class="custom-modal-body">
                            <?php
                            foreach ($data as $key => $value) :
                                ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-4 text-right">
                                                <label for="<?php echo $key ?>"
                                                       class="label control-label"><?php echo ucwords(str_replace("_", " ", $key)) ?></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <?php if ($type == 'information' || $type=='social') : ?>
                                                    <input id="<?php echo $key ?>" type="text"
                                                           name="<?php echo $type . '[' . $key . ']' ?>" value="<?php echo $fillables[$type][$key]?>"
                                                           class="form-control">
                                                <?php else : ?>
                                                    <textarea name="<?php echo $type . '[' . $key . ']' ?>"
                                                              id="<?php echo $key ?>" cols="30" rows="10"
                                                              class="form-control"><?php echo $fillables[$type][$key]?></textarea>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="modal-custom">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <input type="submit" name="save" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>