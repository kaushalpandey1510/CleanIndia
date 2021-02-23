
<title>Ministry | <?php echo $this->config->item('app_name'); ?></title>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            
            

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Add Ministry</strong> 
                        </div>


                        <form action="<?php echo base_url() ?>admin/ministry/save" method="post" class="form-horizontal" id="ministryFrom">
                            <div class="card-body card-block">

                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Ministry Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="text" id="hf-email" name="ministry_name" placeholder="Ministry Name" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Contact Person</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="text" id="hf-email" name="contact_person" placeholder="Contact Person" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Email</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="text" id="hf-email" name="email" placeholder="Email" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Contact</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="number" id="hf-email" name="mobile" placeholder="Contact No" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Password</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="password" id="hf-email" name="password" placeholder="Enter password" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Category</label>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-check">

                                            <?php
                                            foreach ($category as $c) {
                                                ?>
                                            <div class="checkbox">
                                                <label class="form-check-label ">
                                                    <input type="checkbox" name="category[]" value="<?php echo $c->category_id; ?>" class="form-check-input"><?php echo $c->category_name;  ?>
                                                </label>
                                            </div>
                                                    <?php
                                            }
                                            ?>

                                            
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
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
        $('#ministryFrom').formValidation({
            framework: 'bootstrap',
            fields: {
                ministry_name: {
                    validators: {
                        notEmpty: {
                            message: 'Ministry name cannot be null'
                        },
                        remote: {
                            url: '<?php echo base_url() . 'admin/ministry/unique' ?>',
                            type: 'GET',
                            data: {
                                'ministry_id': 0
                            },
                            message: 'This Ministry already exists'
                        }
                    }
                },
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
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Password cannot be null'
                        }
                    }
                },
                'category[]': {
                    validators: {
                        notEmpty: {
                            message: 'The category cannot be null'
                        }
                    }
                },
                
            }
        });
    });
</script>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
