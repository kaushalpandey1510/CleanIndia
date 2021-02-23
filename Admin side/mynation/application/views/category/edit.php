
<title>Edit Category | <?php echo $this->config->item('app_name'); ?></title>
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
                            <strong>Category</strong> 
                        </div>
                        <div class="card-body card-block">
                            <form action="<?php echo base_url() ?>admin/category/update" method="post" class="form-horizontal" id="categoryEditForm">
                                <div class="row form-group">

                                    <div class="col-12 col-md-6">
                                        <input type="hidden" name="category_id" value="<?php echo $category->category_id ?>" />
                                        <input type="text" id="hf-email" name="category_name" placeholder="Category" class="form-control" value="<?php echo $category->category_name; ?>">
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
        $('#categoryEditForm').formValidation({
            framework: 'bootstrap',
            fields: {
                category_name: {
                    validators: {
                        notEmpty: {
                            message: 'The category name is required'
                        },
                        remote: {
                            url: '<?php echo base_url() . 'admin/category/unique' ?>',
                            type: 'GET',
                            data: {
                                'category_id': 0
                            },
                            message: 'This category already exists'
                        }
                    }
                }
            }
        });
    });
</script>
