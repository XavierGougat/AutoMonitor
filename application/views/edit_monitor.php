<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('Monitor/updateMonitor/'.$monitor[0]['monitorId']);?>">
                    <h5>Monitor informations</h5>
                    <br>

                    <div class="form-group has-feedback">

                        <label class="col-sm-3 control-label"> Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="<?php echo $monitor[0]['monitorName'];?>" name="name" value="<?php echo set_value('adress', isset($monitor[0]['monitorName']) ? $monitor[0]['monitorName'] : ''); ?>">
                            <i class="fa fa-tag form-control-feedback l-h-34"></i>
                            <span class="text-danger"><?php echo form_error('name'); ?></span>

                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label"> Adress/ip</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="<?php echo $monitor[0]['monitorAdress'];?>" name="adress" value="<?php echo set_value('adress', isset($monitor[0]['monitorAdress']) ? $monitor[0]['monitorAdress'] : ''); ?>">
                            <i class="fa fa-globe form-control-feedback l-h-34"></i>
                            <span class="text-danger"><?php echo form_error('adress'); ?></span>

                        </div>
                    </div>
                    <hr>
                    <h5>Alert notifications</h5>
                    <br>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label"> Contact</label>
                        <div class="col-sm-6">
                            <?php foreach($contacts as $contact){?>
                            <div class="checkbox checkbox-custom checkbox-circle">
                                <input id="<?php echo $contact->address;?>" type="checkbox" value="<?php echo $contact->id;?>" name="contact[]" class="<?php echo $contact->type;?>"
                                <?php if(in_array($contact->id,$notifications))echo'checked';?> />
                                <label for="<?php echo $contact->address;?>">
                                    <?php echo $contact->address;?>
                                    <i class="fa fa-envelope text-custom"></i>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-3 col-sm-offset-3">
                        <a href="<?php echo site_url('Monitor/viewMonitor/'.$monitor[0]['monitorId']);?>" class="btn btn-lg btn-block btn-default">Cancel <i class="fa fa-undo"></i></a>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-lg btn-block btn-default">Update <i class="fa fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div><!-- end row -->
    </div> <!-- end col -->
</div> <!-- end row -->