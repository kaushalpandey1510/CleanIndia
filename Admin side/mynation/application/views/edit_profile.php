
<title>Edit Profile | <?php echo $this->config->item('app_name'); ?></title>
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
                            <strong>Update Profile</strong> 
                        </div>


                        <form action="<?php echo base_url() ?>account/update_profile" method="post" class="form-horizontal" id="ministryEditFrom">
                            <div class="card-body card-block">

                                
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Contact Person</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="text" id="hf-email" name="contact_person" placeholder="Contact Person" class="form-control" value="<?php echo $ministry->contact_person ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Email</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="text" id="hf-email" name="email" placeholder="Email" class="form-control" value="<?php echo $ministry->email ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Contact</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="number" id="hf-mobile" name="mobile" placeholder="Contact No" class="form-control" value="<?php echo $ministry->mobile ?>">
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <a href="<?php echo base_url() ?>welcome" class="btn btn-danger btn-sm">
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
