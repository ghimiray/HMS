<style>
    .custom-modal {
        background: #FFF;
        margin: 10px;
    }

    .form-group {
        border-bottom: 1px solid #efefef;
    }

    .value-container {
        padding: 10px;
    }
</style>
<div class="custom-modal">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="<?php echo base_url('company/edit')?>" class="btn btn-primary">Edit Company Details</a>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin: 0 auto;">
    <div class="row">

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
                                            <div class="value-container">
                                                <?php echo $value ? $value : 'N/A' ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>