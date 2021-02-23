

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Gallery for <strong><?php echo $event->title ?></strong> 
                        </div>
                        
                    </div>
                </div>
            </div>


            <div class="row">


                <?php
                foreach ($event_gallery as $eg) {
                    ?>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="<?php echo base_url() . $eg->image ?>">
                                <img src="<?php echo base_url() . $eg->image ?>" alt="Fjords" style="width:100%">
                                <div class="caption">
                                    <p>Lorem ipsum...</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>


            </div>





        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
