<div class="row">
    <?php if(empty($monitors)){ ?>
    <div id="card4" class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="card-box p-b-0">
            <p>
                <a href="<?php echo site_url('Monitor/addMonitor');?>" class="center-block text-center text-dark">
                    <i class="fa fa-desktop"></i>
                </a></p><div class="h5 m-b-0"><a href="<?php echo site_url('Monitor/addMonitor');?>" class="center-block text-center text-dark"><strong>Lancer une surveillance</strong></a></div><a href="http://localhost:8888/Automonitor/Monitor/viewMonitor/4" class="center-block text-center text-dark">
            </a>
            <p></p>
            <div class="bg-custom pull-in-card p-10 widget-box-two m-b-0 m-t-30 list-inline text-center row">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="<?php echo site_url('Monitor/addMonitor');?>"><h4 class="text-white m-0 font-600"><i class="fa fa-plus-circle"></i></h4></a>
                        <p class="text-white m-b-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }
    foreach($monitors as $monitor){ ?>
    <div id="card<?php echo $monitor['id']; ?>" class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="card-box p-b-0">
            <p>
                <a href="<?php echo site_url('Monitor/viewMonitor/'.$monitor['id']);?>" class="center-block text-center text-dark">
                    <img src="http://www.google.com/s2/favicons?domain=<?php echo $monitor['adress'];?>" class="thumb-xs img-thumbnail img-circle" alt="">
                    <div class="h5 m-b-0"><strong><?php echo $monitor['name']; ?></strong></div>
                </a>
            </p>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="btn-group">
                        <button title="<?php echo $this->lang->line('available'); ?>" class="btn btn-default waves-effect waves-light btn-sm dynamic-alert-ping-<?php echo $this->session->userdata('user_profile_lang');?>" data-monitorid="<?php echo $monitor['id']; ?>" id=""><i class="fa fa-plug"></i></button>
                        <a href="<?php echo site_url('Monitor/viewMonitor/'.$monitor['id']);?>" title="<?php echo $this->lang->line('see_details'); ?>" class="btn btn-default waves-effect waves-light btn-sm" id=""><i class="fa fa-eye"></i></a>
                        <button title="<?php echo $this->lang->line('delete'); ?>" class="btn btn-danger waves-effect waves-light btn-sm delete-<?php echo $this->session->userdata('user_profile_lang');?>" id="<?php echo $monitor['id']; ?>"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <div class="<?php if($monitor['status']=='up'){echo'bg-custom';}else{if($monitor['status']=='started'){echo'bg-primary';}else{echo'bg-danger';}}?> pull-in-card p-10 widget-box-two m-b-0 m-t-30 list-inline text-center row">
                <div class="row">
                    <div class="col-xs-12">
                        <?php if($monitor['status']=='up'){?>
                        <h4 class="text-white m-0 font-600"><i class="fa fa-check-circle-o"></i></h4>
                        <p class="text-white m-b-0"><?php echo $this->lang->line('up'); ?></p>
                        <?php }else{
        if($monitor['status']=='started'){?>
                        <h4 class="text-white m-0 font-600"><i class="fa fa-spinner"></i></h4>
                        <p class="text-white m-b-0"><?php echo $this->lang->line('init'); ?></p>
                        <?php }else{ ?>
                        <h4 class="text-white m-0 font-600"><i class="fa fa-times-circle-o"></i></h4>
                        <p class="text-white m-b-0"><?php echo $this->lang->line('down'); ?></p>
                        <?php }
    } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>