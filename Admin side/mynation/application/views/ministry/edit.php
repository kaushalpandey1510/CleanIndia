
<title>Update Ministry | <?php echo $this->config->item('app_name'); ?></title>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">



            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Update Ministry</strong> 
                        </div>


                        <form action="<?php echo base_url() ?>admin/ministry/update" method="post" class="form-horizontal" id="ministryEditFrom">
                            <div class="card-body card-block">

                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Ministry Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">                                        
                                        <input type="hidden" name="ministry_id" value="<?php echo $ministry->ministry_id ?>">
                                        <input type="text" id="hf-email" name="ministry_name" placeholder="Ministry Name" class="form-control" value="<?php echo $ministry->ministry_name ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="select" class=" form-control-label">Ministry Executive</label>
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
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Assigned Category</strong> 
                        </div>


                        <div class="form-horizontal">
                            <div class="card-body card-block">

                                <div class="row form-group">
                                    <div class="col-12 col-md-6">

                                        <table class="table table-borderless">
                                            <tbody>
                                                <?php
                                                foreach ($category_assigned as $c) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $c->category_name; ?></td>
                                                        <td><a href="<?php echo base_url() ?>admin/ministry/delete_category?ministry_category_id=<?php echo $c->ministry_category_id ?>"><span class="fa fa-remove"></span></a></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Available Category</strong> 
                        </div>

                        <?php
                        if (count($category_remaining) > 0) {
                            ?>
                            <form action="<?php echo base_url() ?>admin/ministry/save_category" method="post" class="form-horizontal">
                                <input type="hidden" name="ministry_id" value="<?php echo $ministry->ministry_id ?>" />
                                <div class="card-body card-block">

                                    <div class="row form-group">
                                        <div class="col-12 col-md-12">
                                            <div class="form-check">

                                                <?php
                                                foreach ($category_remaining as $c) {
                                                    ?>
                                                    <div class="checkbox">
                                                        <label class="form-check-label ">


                                                            <input type="checkbox" name="category[]" value="<?php echo $c->category_id; ?>" class="form-check-input"><?php echo $c->category_name; ?>
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
                            <?php
                        } else {
                            ?>
                            <div class="form-horizontal">
                                <input type="hidden" name="ministry_id" value="<?php echo $ministry->ministry_id ?>" />
                                <div class="card-body card-block">

                                    <div class="row form-group">
                                        <div class="col-12 col-md-6">
                                            <?php echo 'No record found'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


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
