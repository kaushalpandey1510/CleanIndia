
<title>Complains | <?php echo $this->config->item('app_name'); ?></title>
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
                <div class="col-lg-3">
                    <span class="fa fa-circle" style="color: red"></span> New complaint
                </div>
                <div class="col-lg-3">
                    <span class="fa fa-circle" style="color: orange"></span> Pending complaint
                </div>
                <div class="col-lg-3">
                    <span class="fa fa-circle" style="color: gray"></span> Waiting for confirmation
                </div>
                <div class="col-lg-3">
                    <span class="fa fa-circle" style="color: green"></span> Solved
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th></th>
                                    <th>Complaint Id</th>
                                    <th>Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                foreach ($complaint as $c) {
                                    ?> 
                                    <tr>
                                        <td><?php echo $srno ?></td>
                                        <td>
                                            <?php if ($c->category_id == null || $c->category_id == 0) {
                                                ?>
                                                <span class="fa fa-circle" style="color: red"></span>
                                                <?php
                                            } else if (($c->resolve == null && $c->resolve_confirm == null) || ($c->resolve != null && $c->resolve_confirm == '0')) {
                                                ?>
                                                <span class="fa fa-circle" style="color: orange"></span>
                                                <?php
                                            } else if ($c->resolve != null && ($c->resolve_confirm == null) || $c->resolve_confirm == '0') {
                                                ?>
                                                <span class="fa fa-circle" style="color: gray"></span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="fa fa-circle" style="color: green"></span>
                                                <?php
                                            }
                                            ?>

                                        </td>
                                        <td><a href="<?php echo base_url() ?>admin/complaint/detail?complaint_id=<?php echo $c->complaint_id ?>"><?php echo $c->complaint_id; ?></a></td>
                                        <td><?php echo $c->title; ?></td>
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
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
