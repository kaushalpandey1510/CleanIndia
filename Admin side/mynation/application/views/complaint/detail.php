<title>Complain Details | <?php echo $this->config->item('app_name'); ?></title>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

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
                                            <?php if ($complaint->resolve_confirm != '1') { ?>
                                                <form action="<?php echo base_url() ?>admin/complaint/assign" method="post" class="form-horizontal">
                                                    <input type="hidden" name="complaint_id" value="<?php echo $complaint->complaint_id ?>" /> 
                                                    <div class="row form-group">
                                                        <div class="col col-md-2">
                                                            <label for="Category" class=" form-control-label"><strong>Category</strong></label>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <select name="category_id" id="select" class="form-control">
                                                                <option value="">Please select</option>

                                                                <?php
                                                                foreach ($category as $c) {
                                                                    if ($c->category_id == $complaint->category_id) {
                                                                        ?>
                                                                        <option selected value="<?php echo $c->category_id ?>"><?php echo $c->category_name ?></option>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <option value="<?php echo $c->category_id ?>"><?php echo $c->category_name ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>


                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <?php if ($complaint->category_id != null && $complaint->category_id != 0) {
                                                                ?>
                                                                <button type="submit" class="btn btn-success m-l-10 m-b-10">Reassign</button> 
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <button type="submit" class="btn btn-success m-l-10 m-b-10">Assign

                                                                </button>
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>

                                                    </div>
                                                </form>
                                            <?php } ?>
                                            <div class="row form-group">
                                                <div class=" col-md-2">
                                                    <label for="Status" class=" form-control-label"><strong>Status</strong></label>

                                                </div>
                                                <div class="col-md-4">

                                                    <?php if ($complaint->category_id == null || $complaint->category_id == 0) {
                                                        ?>
                                                        <span class="badge badge-danger">New Complaint</span>
                                                        <?php
                                                    } else if (($complaint->resolve == null && $complaint->resolve_confirm == null) || ($complaint->resolve != null && $complaint->resolve_confirm == '0')) {
                                                        ?>
                                                        <span class="badge badge-warning">Assigned & Pending to solve</span>
                                                        <?php
                                                    } else if ($complaint->resolve != null && ($complaint->resolve_confirm == null) || $complaint->resolve_confirm == '0') {
                                                        ?>
                                                        <span class="badge badge-dark">Solved but waiting from admin confirmation</span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="badge badge-success">Solved</span>
                                                        <?php
                                                    }
                                                    ?>


                                                </div>

                                            </div>
                                            <?php if ($complaint->resolve != null && $complaint->resolve_confirm == null) { ?>
                                                <form action="<?php echo base_url() ?>admin/complaint/confirm_solution" method="post" class="form-horizontal">
                                                    <input type="hidden" name="complaint_id" value="<?php echo $complaint->complaint_id ?>" /> 
                                                    <div class="row form-group">
                                                        <div class=" col-md-3">
                                                            <label for="Status" class=" form-control-label"><strong>Problem Solution</strong></label>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="resolve_confirm" class="form-control">
                                                                <option>Select option</option>
                                                                <option value="1">Confirm</option>
                                                                <option value="0">Reject</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="submit" class="btn btn-success m-l-10 m-b-10">Assign

                                                            </button>


                                                        </div>

                                                    </div>
                                                </form>
                                            <?php } ?>

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
