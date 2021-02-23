
<title>Change Password| <?php echo $this->config->item('app_name'); ?></title>
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
                            <strong>Change Password</strong> 
                        </div>


                        <form action="<?php echo base_url() ?>admin/account/change_password" method="post" class="form-horizontal" id="ministryEditFrom">
                            <div class="card-body card-block">

                                
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">New Password</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="password" id="hf-email" name="password" placeholder="New password" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Confirm Password</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="password" id="hf-email" name="cpassword" placeholder="Confirm password" class="form-control">
                                    </div>
                                </div>
                                


                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <a href="<?php echo base_url() ?>admin/welcome" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#ministryEditFrom').formValidation({
            framework: 'bootstrap',
            fields: {
                
                contact_person: {
                    validators: {
                        notEmpty: {
                            message: 'Contact Person cannot be null'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email cannot be null'
                        }
                    }
                },
                mobile: {
                    validators: {
                        notEmpty: {
                            message: 'Mobile number cannot be null'
                        },
                        stringLength: {
                            min: 10,
                            max: 10,
                            message: 'Mobile number must be of 10 digits'
                        }
                    }
                },
                
                
            }
        });
    });
</script>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
