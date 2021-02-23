
<title> Category | <?php echo $this->config->item('app_name'); ?></title>
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
                            <form action="<?php echo base_url() ?>admin/category/save" method="post" class="form-horizontal" id="categoryForm">
                                <div class="row form-group">

                                    <div class="col-12 col-md-6">
                                        <input type="text" id="hf-email" name="category_name" placeholder="Category" class="form-control">
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                foreach ($category as $c) {
                                    ?>
                                    <tr>
                                        <td><?php echo $srno ?></td>
                                        <td><?php echo $c->category_name; ?></td>
                                        <td>
                                            <div class="row fontawesome-icon-list">
                                                <div class="fa-hover col-lg-3 col-md-6">
                                                    <a href="<?php echo base_url() ?>admin/category/edit?category_id=<?php echo $c->category_id ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a onclick="return confirm('Do you really want to delete this record?')" href="<?php echo base_url() ?>admin/category/delete?category_id=<?php echo $c->category_id ?>">
                                                        <i class="fa fa-trash"></i></a>    
                                                </div>
                                            </div>

                                        </td>
                                    </tr>                    
                                    <?php
                                    $srno++;
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
<script>
    $(document).ready(function () {
        $('#categoryForm').formValidation({
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
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
