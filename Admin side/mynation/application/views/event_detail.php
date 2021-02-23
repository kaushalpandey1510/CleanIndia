<title> Event Detail | <?php echo $this->config->item('app_name'); ?></title>
<script>
    function fetch_city(state_id)
    {
        $.ajax({
            url: '<?php echo base_url() ?>admin/city/get_by_state_id',
            type: 'post',
            data: {
                'state_id': state_id
            },
            success: function (result) {

                result = JSON.parse(result);
                $("#city_id").empty();
                $("#city_id").append('<option value="">City</option>');
                for (var i = 0; i < result.length; i++)
                {
                    //console.log(result[i]['city_name']);
                    $("#city_id").append('<option value=' + result[i]['city_id'] + '>' + result[i]['city_name'] + '</option>');
                }

            }
        });
    }
</script>
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
                        <form action="<?php echo base_url() ?>admin/event/update" method="post" class="form-horizontal">
                            <div class="row form-group">

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Update Event</strong> 
                                        </div>
                                        <div class="card-body card-block">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Event Type & Title</label>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <input type="hidden" name="event_id" value="<?php echo $event->event_id ?>">
                                                    <select name="event_type_id" id="select" class="form-control">
                                                        <option value="">Event Type</option>
                                                        <?php
                                                        foreach ($event_type as $et) {
                                                            if($et->event_type_id == $event->event_type_id) {
                                                                ?>
                                                                <option selected="" value="<?php echo $et->event_type_id ?>"><?php echo $et->event_type_name ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                    <option value="<?php echo $et->event_type_id ?>"><?php echo $et->event_type_name ?></option>
                                                                
                                                                <?php }
                                                                }
                                                    ?>


                                                        </select>
                                                        <small class="form-text text-muted">Please Select Event's Type</small>
                                                    </div>
                                                    <div class="col-12 col-md-3">

                                                        <input type="text" id="text-input" placeholder="Title " name="title"  class="form-control" value="<?php echo $event->title ?>">
                                                        <small class="form-text text-muted">Please enter Event's Title</small>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <input type="datetime-local" id="text-input" placeholder="" name="event_date"  class="form-control" value="<?php echo $date.'T'.$time ?>">
                                                        
                                                        
                                                        <small class="form-text text-muted">Select the event date</small>
                                                    </div>
                                                </div>                                            

                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="textarea-input" class=" form-control-label">Purpose</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <textarea name="purpose" id="textarea-input" rows="5" placeholder="Purpose..." class="form-control" ><?php echo $event->purpose?></textarea>
                                                        <small class="form-text text-muted">Please enter detailed description of Event</small>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="text-input" class=" form-control-label">Address</label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <input type="text" id="text-input" name="address" placeholder="Address" class="form-control" value="<?php echo $event->address ?>">
                                                        <small class="form-text text-muted">Please enter Address of Event</small>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="select" class=" form-control-label">State</label>

                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <select name="state_id" id="select" class="form-control" onchange="fetch_city(this.value)">
                                                            <option value="">State</option>
                                                            <?php
                                                            foreach ($state as $st) {
                                                                if ($st->state_id == $event->state_id) {
                                                                    ?>
                                                                    <option selected="" value="<?php echo $st->state_id ?>"><?php echo $st->state_name ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $st->state_id ?>"><?php echo $st->state_name ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select>
                                                        <small class="form-text text-muted">Please Select State</small>
                                                    </div>
                                                    <div class="col-12 col-md-4">

                                                        <select name="city_id" id="city_id" class="form-control">
                                                            <option value="">City</option>
                                                            <?php
                                                            foreach ($city as $ct) {
                                                                if ($ct->city_id == $event->city_id) {
                                                                    ?>
                                                                    <option selected="" value="<?php echo $ct->city_id ?>"><?php echo $ct->city_name ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <option value="<?php echo $ct->city_id ?>"><?php echo $ct->city_name ?></option>
                                                            <?php }
                                                            ?>
                                                    </select>
                                                    <small class="form-text text-muted">Please Select City</small>
                                                </div>                                                          

                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Email & Contact</label>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <input type="email" id="email-input" name="email" placeholder="Enter Email" class="form-control" value="<?php echo $event->email?>">
                                                    <small class="help-block form-text">Please enter your email</small>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <input type="number" id="email-input" name="mobile" placeholder="Contact Number" class="form-control" value="<?php echo $event->mobile?>">
                                                    <small class="help-block form-text">Please enter your Contact Number</small>
                                                </div>


                                            </div>
                                            
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Submit
                                            </button>
                                            <button type="reset" class="btn btn-danger btn-sm">
                                                <i class="fa fa-ban"></i> Reset
                                            </button>
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

