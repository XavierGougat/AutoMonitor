<?php if(count($monitorEvents)>0){?>
<div class="row">
    <div class="col-sm-12">
        <?php if(isset($monitorsDown) && count($monitorsDown)>=1){ ?>
        <div class="alert alert-icon alert-white alert-danger alert-dismissible fade in" role="alert">
            <p>
                <i class="fa fa-toggle-off"></i>
                <?php echo $this->lang->line('monitors_are_down'); ?>
            </p>
            <?php foreach($monitorsDown as $monitor){ ?>
            <p>
                <a class="btn btn-xs btn-danger" href="<?php echo site_url('Monitor/viewMonitor/'.$monitor['monitorId'])?>"><?php echo 'Monitor <strong>'.$monitor['name'].'</strong> is down. Http status is <strong>'.$monitor['lastStatus'].'</strong>.';?></a>
            </p>
            <?php } ?>
        </div>
        <?php }else{ ?>
        <div class="alert alert-icon alert-white alert-success alert-dismissible fade in" role="alert">
            <p>
                <i class="fa fa-toggle-on"></i>
                <?php echo $this->lang->line('monitors_are_up'); ?>
            </p>
        </div>
        <?php } ?>
    </div>
</div>
<!--end row -->
<div class="row">
    <div class="col-sm-12">
        <div class="card-box widget-inline">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="widget-inline-box text-center b-0">
                        <p>
                            <i class="fa fa-signal text-primary"></i>
                        </p>
                        <p>
                            <strong><?php echo bcdiv($dayUptimeUser,1,2) ; ?>%</strong>
                            <span style="font-size:10px;" class="text-muted"><?php echo $this->lang->line('last_day_uptime'); ?></span>
                        </p>
                        <p>
                            <strong><?php echo bcdiv($weekUptimeUser,1,2) ; ?>%</strong>
                            <span style="font-size:10px;" class="text-muted"><?php echo $this->lang->line('last_week_uptime'); ?></span>
                        </p>
                        <p>
                            <strong><?php echo bcdiv($monthUptimeUser,1,2) ; ?>%</strong>
                            <span style="font-size:10px;" class="text-muted"><?php echo $this->lang->line('last_month_uptime'); ?></span>
                        </p>

                        <p>
                            <strong><?php echo bcdiv($overallUptimeUser,1,2) ; ?>%</strong>
                            <span style="font-size:10px;" class="text-muted"><?php echo $this->lang->line('overall_uptime'); ?></span>
                        </p>
                        </p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="widget-inline-box text-center">
                    <?php if($lastDownTime[0]['maxTime']>0){?>
                    <i class="text-danger fa fa-power-off"></i>
                    <h3 class="m-t-10">
                        <b style="font-size:14px;" data-plugin="counterup"> 
                            <?php
    echo strftime('%x<br>%X',strtotime($lastDownTime[0]['maxTime']));
                            ?>
                        </b>
                    </h3>
                    <p class="text-muted"><?php echo $this->lang->line('was_last_downtime'); ?></p>
                    <?php }else{ ?>
                    <i class="fa fa-thumbs-o-up text-primary"></i>
                    <h3 class="m-t-10">-</h3>
                    <p class="text-muted"><?php echo $this->lang->line('no_downtime'); ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="widget-inline-box text-center">
                    <input data-plugin="knob" data-width="100" data-height="60" data-min="0" data-max="<?php echo count($monitors);?>"
                           data-fgColor="#CD6C80" readOnly="true" data-angleOffset=-125
                           data-angleArc=250 value="<?php echo count($monitorsDown);?>"/>
                    <p class="text-muted"><?php echo $this->lang->line('down_monitors'); ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="widget-inline-box text-center">
                    <input data-plugin="knob" data-width="100" data-height="60" data-min="0" data-max="<?php echo count($monitors);?>"
                           data-fgColor="#548B99" readOnly="true" data-angleOffset=-125
                           data-angleArc=250 value="<?php echo count($monitorsUp);?>"/>
                    <p class="text-muted"><?php echo $this->lang->line('up_monitors'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table id="datatable-responsive-<?php echo $this->session->userdata('user_profile_lang');?>" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('event'); ?></th>
                    <th><?php echo $this->lang->line('monitor'); ?></th>
                    <th><?php echo $this->lang->line('datetime'); ?></th>
                    <th><?php echo $this->lang->line('response'); ?></th>
                    <th><?php echo $this->lang->line('duration'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($monitorEvents as $event){ ?>
                <tr class="<?php echo $event['statusColor'];?>">
                    <td>
                        <span class="label label-<?php echo $event['statusColor'];?>">
                            <i class="fa fa-arrow-<?php echo $event['statusLabel'];?>"> <?php echo $event['statusLabel'];?></i>
                        </span>
                    </td>
                    <td><img width="16" src="http://www.google.com/s2/favicons?domain=<?php echo $event['monitorAdress'];?>" /> <a href="<?php echo site_url('Monitor/viewMonitor/'.$event['monitorId']);?>"><?php echo $event['monitorName'];?></a></td>
        <td><?php echo strftime('%x - %X',strtotime($event['dateTime']));?></td>
        <td><span class="text-<?php echo $event['statusColor'];?>"><?php echo $event['monitorStatus'];?></span></td>
        <td><?php if($event['statusLabel']=="started"){echo"<span class='text-muted'>n/a</span>";}else{echo $event['duration'];}?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
</div>
<?php }else{ ?>
<div class="row">
    <div class="col-sm-12">
        <div class="text-center">
            <i class="fa fa-plug fa-4x text-custom"></i>
            <h3 class="font-600"><?php echo $this->lang->line('add_a_monitor'); ?></h3>
            <p class="text-muted"> Vous êtes notifiés dès que votre moniteur présente des défaillances ! (site injoignable, ralentissements...)<br> Nous vous alertons dans la minute par mail et SMS.
            </p>
            <p>
                <a href="<?php echo site_url('Monitor/addMonitor');?>" class="btn btn-lg btn-custom m-t-10"><?php echo $this->lang->line('add_a_monitor_button'); ?> <i class="fa fa-plus-circle"></i></a>
            </p>
            <p>
                <a style="font-size:11px;" href="#">Liste des défaillances possibles</a>
            </p>
        </div>
    </div>
</div>
<?php } ?>