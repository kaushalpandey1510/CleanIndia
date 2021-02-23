<title>Complain Details | <?php echo $this->config->item('app_name'); ?></title>
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

                    <div class="card-body card-block">

                        <div class="row form-group">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Complain Details</strong> 
                                    </div>
                                    <div class="card-body card-block">
                                        
                                        <?php if ($complaint->new_photo == NULL) { ?>
                                            <div class="col col-md-4">
                                                <label><strong>Before Solution</strong></label>
                                                <img src="<?php echo base_url() . $complaint->photo ?>" />
                                            </div>

                                        <?php } else { ?>
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label><strong>Before Solution</strong></label>
                                                    <img src="<?php echo base_url() . $complaint->photo ?>" />
                                                </div>
                                                <div class="col col-md-4">
                                                    <label><strong>After Solution</strong></label>
                                                    <img src="<?php echo base_url() . $complaint->new_photo ?>" />
                                                </div>

                                            </div>

                                            <?php } ?>

                                        <br />
                                        
                                        <form action="<?php echo base_url() ?>complaint/solve" method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <input type="hidden" name="complaint_id" value="<?php echo $complaint->complaint_id ?>" /> 
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="text-input" class=" form-control-label"><strong>Complain Id</strong></label>
                                                </div>
                                                <div class="col-3 col-md-4">
                                                    <label for="complaint_id"> <?php echo $complaint->complaint_id ?> </label>                     
                                                </div>
                                                <div class="col col-md-2">
                                                    <label for="text-input" class=" form-control-label"><strong>Title</strong></label>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="title" value=""><?php echo $complaint->title ?> </label>                     
                                                </div>

                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="text-input" class=" form-control-label"><strong>Complainer</strong></label>
                                                </div>
                                                <div class="col-3 col-md-4">
                                                    <label> <?php echo $complaint->name ?></label>                     
                                                </div>

                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="email-input" class=" form-control-label"><strong>Email</strong></label>
                                                </div>
                                                <div class="col-3 col-md-4">
                                                    <label> <?php echo $complaint->email ?></label>                     
                                                </div>

                                                <div class="col col-md-2">
                                                    <label for="email-input" class=" form-control-label"><strong>Contact</strong></label>
                                                </div>
                                                <div class="col-3 col-md-4">
                                                    <label> <?php echo $complaint->phone_number ?></label>                     
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="text-input" class=" form-control-label"><strong>Description</strong></label>
                                                </div>
                                                <div class="col-3 col-md-9">
                                                    <label> <?php echo $complaint->description ?></label>                     
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="text-input" class=" form-control-label"><strong>Address</strong></label>
                                                </div>
                                                <div class="col-3 col-md-9">
                                                    <label> <?php echo $complaint->address.', '.$complaint->city_name.', '.$complaint->state_name ?></label>                     
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="State" class=" form-control-label"><strong>Place</strong></label>
                                                </div>
                                                <div class="col-3 col-md-4">
                                                    <label><?php echo $complaint->public_place_name ?></label>                     
                                                </div>
                                                
                                            </div>                                             

                                            <?php
                                            if ($complaint->resolve == null || $complaint->resolve_confirm == 0) {
                                                ?>
                                                <div class="row form-group">
                                                    <div class="col col-md-2">
                                                        <label for="Category" class=" form-control-label"><strong>New Image</strong></label>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <input type="file" name="image" />
                                                    </div>
                                                    <div class="col-md-4">

                                                        <button type="submit" class="btn btn-success m-l-10 m-b-10">Solve</button> 


                                                    </div>

                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <div class="row form-group">
                                                <div class=" col-md-2">
                                                    <label for="Status" class=" form-control-label"><strong>Status</strong></label>

                                                </div>
                                                <div class="col-md-4">

                                                    <?php
                                                    if ($complaint->resolve == null && $complaint->resolve_confirm == null) {
                                                        ?>
                                                        <span class="badge badge-danger">New Complaint</span>
                                                        <?php
                                                    } else if ($complaint->resolve != null && $complaint->resolve_confirm == null) {
                                                        ?>
                                                        <span class="badge badge-warning">Solved but waiting for admin approval</span>
                                                        <?php
                                                    } else if ($complaint->resolve != null && $complaint->resolve_confirm == 0) {
                                                        ?>
                                                        <span class="badge badge-dark">Rejected from admin</span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="badge badge-success">Solved</span>
                                                        <?php
                                                    }
                                                    ?>



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
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
