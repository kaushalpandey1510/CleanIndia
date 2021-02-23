
<title>Edit Public Place | <?php echo $this->config->item('app_name'); ?></title>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <?php
            if ($this->session->flashdata('msg') != null) {
                ?>
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    <?php echo $this->session->flashdata('msg') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            } else if ($this->session->flashdata('err') != null) {
                ?>
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Failure</span>
                    <?php echo $this->session->flashdata('err') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>        
                <?php
            }
            ?>




            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Public Place</strong> 
                        </div>
                        <div class="card-body card-block">
                            <form action="<?php echo base_url() ?>admin/public_place/update" method="post" class="form-horizontal" id="publicPlaceEditForm">
                                <div class="row form-group">

                                    <div class="col-12 col-md-6">
                                        <input type="hidden" name="public_place_id" value="<?php echo $public_place->public_place_id ?>" />
                                        <input type="text" id="hf-email" name="public_place_name" placeholder="Public Place" class="form-control" value="<?php echo $public_place->public_place_name; ?>">
                                    </div>
                                    <div class="col col-md-2">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
<script>
    $(document).ready(function () {
        $('#publicPlaceEditForm').formValidation({
            framework: 'bootstrap',
            fields: {
                public_place_name: {
                    validators: {
                        notEmpty: {
                            message: 'Public Place cannot be Null'
                        },
                        remote: {
                            url: '<?php echo base_url() . 'admin/public_place/unique' ?>',
                            type: 'GET',
                            data: {
                                'public_place_id': 0
                            },
                            message: 'This public place already exists'
                        }
                    }
                }
            }
        });
    });
</script>