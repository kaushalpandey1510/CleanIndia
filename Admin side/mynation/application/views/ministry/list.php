
<title>Ministry | <?php echo $this->config->item('app_name'); ?></title>
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
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Ministry Name</th>
                                    <th>Ministry Executive</th>
                                    <th>E-mail</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                foreach ($ministry as $c) {
                                    ?>
                                    <tr>
                                        <td><?php echo $srno ?></td>
                                        <td><?php echo $c->ministry_name; ?></td>
                                        <td><?php echo $c->contact_person; ?></td>
                                        <td><?php echo $c->email; ?></td>
                                        <td><?php echo $c->mobile; ?></td>
                                        <td>
                                            <div class="row fontawesome-icon-list">
                                                <div class="fa-hover col-lg-3 col-md-6">
                                                    <a href="<?php echo base_url() ?>admin/ministry/edit?ministry_id=<?php echo $c->ministry_id ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url() ?>admin/ministry/delete?ministry_id=<?php echo $c->ministry_id ?>">
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