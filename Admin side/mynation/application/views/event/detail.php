<title> Event Detail | <?php echo $this->config->item('app_name'); ?></title>
<!-- MAIN CONTENT-->

<?php
$datetime = strtotime($event->event_date);
$date = date('Y-m-d', $datetime);
$time = date('H:i', $datetime);
?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">

                    <div class="card-body card-block">
                        <form action="#" method="post" class="form-horizontal">
                            <input type="hidden" name="event_id" value="<?php echo $event->event_id ?>" /> 
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Event Details</strong> 
                                        </div>
                                        <div class="card-body card-block">
                                            <div>
                                                <div><label><strong>Event Image</strong></label></div>
                                                <div><img src="<?php echo base_url() . $event->image ?>" /></div>
                                                    
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label"><strong> Event Type & Title </strong></label>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="event_type"> <?php echo $event->event_type_name ?> </label>                                                  
                                                    <!--<small class="form-text text-muted">Please Select Event's Type</small> -->
                                                </div>

                                            </div>                                            

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label"><strong> Purpose </strong></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="purpose"> <?php echo $event->purpose ?> </label>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label"><strong> Address </strong></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="purpose"> <?php echo $event->address ?> </label>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label"><strong> State </strong></label>

                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="purpose"> <?php echo $event->state_name ?> </label>
                                                </div>
                                                <div class="col-12 col-md-4">


                                                </div>                                                          

                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label"><strong> Email & Contact </strong></label>
                                                </div>                                                
                                                <div class="col-12 col-md-9">
                                                    <label for="purpose"> <?php echo $event->email ?> <?php echo '    --    ' ?><?php echo $event->mobile ?> </label>
                                                </div>

                                            </div>

                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <a type="submit" class="btn btn-primary btn-sm" href="<?php echo base_url() ?>admin/event">
                                                <i class="fa fa-dot-circle-o"></i> Back
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->

