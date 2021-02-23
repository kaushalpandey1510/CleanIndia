
<title> Event Type | <?php echo $this->config->item('app_name'); ?></title>
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
                            <strong>Event Type</strong> 
                        </div>
                        <div class="card-body card-block">
                            <form action="<?php echo base_url() ?>admin/event_type/save" method="post" class="form-horizontal" id="eventTypeForm">
                                <div class="row form-group">

                                    <div class="col-12 col-md-6">
                                        <input type="text" id="hf-email" name="event_type_name" placeholder="Event Type" class="form-control">
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
                                    <th>Event Type Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                foreach ($event_type as $c) {
                                    ?>
                                    <tr>
                                        <td><?php echo $srno ?></td>
                                        <td><?php echo $c->event_type_name; ?></td>
                                        <td>
                                            <div class="row fontawesome-icon-list">
                                                <div class="fa-hover col-lg-3 col-md-6">
                                                    <a href="<?php echo base_url() ?>admin/event_type/edit?event_type_id=<?php echo $c->event_type_id ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url() ?>admin/event_type/delete?event_type_id=<?php echo $c->event_type_id ?>">
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
        $('#eventTypeForm').formValidation({
            framework: 'bootstrap',
            fields: {
                event_type_name: {
                    validators: {
                        notEmpty: {
                            message: 'The Event Type is required'
                        },
                        remote: {
                            url: '<?php echo base_url() . 'admin/event_type/unique' ?>',
                            type: 'GET',
                            data: {
                                'event_type_id': 0
                            },
                            message: 'This event type already exists'
                        }
                    }
                }                
            }
        });
    });
</script>

<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
