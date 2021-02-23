
<title>Edit Event Type | <?php echo $this->config->item('app_name'); ?></title>
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
                            <form action="<?php echo base_url() ?>admin/event_type/update" method="post" class="form-horizontal" id="eventTypeEditForm">
                                <div class="row form-group">

                                    <div class="col-12 col-md-6">
                                        <input type="hidden" name="event_type_id" value="<?php echo $event_type->event_type_id ?>" />
                                        <input type="text" id="hf-email" name="event_type_name" placeholder="Event Type" class="form-control" value="<?php echo $event_type->event_type_name; ?>">
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
        $('#eventTypeEditForm').formValidation({
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