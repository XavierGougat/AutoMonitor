<div class="row">
    <div class="col-sm-10">
        <h4>
            <img width="16" src="http://www.google.com/s2/favicons?domain=<?php echo $monitor[0]['monitorAdress'];?>" /> <?php echo $monitor[0]['monitorName'].' - '.$monitor[0]['monitorAdress'];?>
            <a href="<?php echo site_url('Monitor/editMonitor/'.$monitor[0]['monitorId']);?>" class="text-primary"><i class="fa fa-pencil"></i></a>
        </h4>
        </h5>
    </div>
    <div class="col-sm-2 text-right">
        <p><label data-toggle="tooltip" data-html="true" title="<?php foreach($addresses as $address){ echo $address['address'].'<br>';} ?>" class="label label-default"><i class="fa fa-bell"></i></label></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <div class="widget-inline-box text-center b-0">
                <h3><i class="text-<?php echo $monitorEvents[count($monitorEvents)-1]['statusColor'];?> fa fa-square"></i> <?php echo strtoupper($monitorEvents[count($monitorEvents)-1]['statusLabel']); ?></h3>
                <p class="text-muted">Live status</p>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <div class="widget-inline-box text-center">
                <h3>
                    <i class="text-custom fa fa-spinner"></i> 
                    <?php echo $avgLoadNow['loadTime'].' s';?>
                </h3>
                <p class="text-muted">AVG load time</p>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <div class="widget-inline-box text-center">
                <h3>
                    <i class="text-danger fa fa-power-off"></i> 
                    <?php 
                    if($lastDownTime[0]['maxTime']>0){
                        echo date("F j, Y",strtotime($lastDownTime[0]['maxTime']))."<br>".date("g:i a",strtotime($lastDownTime[0]['maxTime']));
                    }else{
                        echo "N/A";
                    }?>
                </h3>
                <p class="text-muted">Last downtime</p>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <h4>Uptime <?php echo round($uptime['Percentage'],3); ?>%<span style="font-size:11px;margin-top:10px;" class="text-default muted pull-right">for the last 100 days</span></h4>
        <div class="progress" style="height:20px;">
            <?php 
            if(isset($monitorEventsDown) && !empty($monitorEventsDown)){
                foreach($monitorEventsDown as $event){ 
                    if($event['percentStart'] != null){ ?>
            <div role="progressbar" aria-valuenow="<?php echo $event['percentStart'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $event['percentStart'];?>%;" class="progress-bar progress-bar-custom"></div>
            <?php } ?>
            <div role="progressbar" aria-valuenow="<?php echo $event['percent'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $event['percent'];?>%;" class="progress-bar progress-bar-danger" data-toggle="tooltip" data-placement="top" title="<?php echo $event['dateTime'];?><br>Down for <?php echo round($event['duration']/60);?>m" data-html="true"></div>
            <?php if($event['interval'] != null){ ?>
            <div role="progressbar" aria-valuenow="<?php echo $event['interval'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $event['interval'];?>%;" class="progress-bar progress-bar-custom"></div>
            <?php }
                    if($event['percentFinish'] != null){ ?>
            <div role="progressbar" aria-valuenow="<?php echo $event['percentFinish'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $event['percentFinish'];?>%;" class="progress-bar progress-bar-custom"></div>
            <?php }  
                }
            }else{ ?>
            <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;" class="progress-bar progress-bar-custom"></div> 
            <?php }
            ?>
        </div>
    </div>
</div>
<hr>
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
                <tr>
                    <td>
                        <span class="label label-<?php echo $event['statusColor'];?>">
                            <i class="fa fa-arrow-<?php echo $event['statusLabel'];?>"> <?php echo $event['statusLabel'];?></i>
                        </span>
                    </td>
                    <td><i class="fa fa-globe"> <?php echo $event['monitorName'];?></i></td>
                    <td><?php echo $event['dateTime'];?></td>
                    <td><span class="text-custom"><?php echo $event['monitorStatus'];?></span></td>
                    <td><?php if($event['statusLabel']=="started"){echo"<span class='text-muted'>n/a</span>";}else{echo $event['duration'];}?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<hr>
<!--<div class="row">
    <div class="col-sm-12">
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="widget-inline-box text-center b-0">
                <h3><i class="text-custom fa fa-spinner"></i> <?php echo floor($overallMinLoadTime[0]['loadTime']*100)/100; ?> s</h3>
                <p class="text-muted">Min. load time</p>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="widget-inline-box text-center">
                <h3>
                    <i class="text-danger fa fa-spinner"></i> 
                    <?php echo floor($overallMaxLoadTime[0]['loadTime']*100)/100; ?> s
                </h3>
                <p class="text-muted">Max. load time</p>
            </div>
        </div>
    </div>
</div>-->
<!-- end row -->