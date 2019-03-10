<div class="row">
    <div class="col-md-6">
        <div class="well-block">
            <form role="form" method="post" action="<?php echo site_url('Monitor/insertMonitor');?>">
                <!-- Form start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="name"><?php echo $this->lang->line('monitor_name'); ?></label>
                            <input placeholder="<?php echo $this->lang->line('monitor_name_placeholder'); ?>" name="name" type="text" value="<?php echo set_value('name');?>" class="form-control input-md">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Text input-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="email"><?php echo $this->lang->line('monitor_address'); ?></label>
                            <input placeholder="<?php echo $this->lang->line('monitor_address_placeholder'); ?>" name="adress" value="<?php echo set_value('adress');?>" type="text" class="form-control input-md">
                            <span class="text-danger"><?php echo form_error('adress'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Select Basic -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="appointmentfor"><?php echo $this->lang->line('interval'); ?></label>
                            <?php if($_SESSION['user_profile_premium']){?>
                            <input name="checkInterval" type="hidden" value="1">
                            <span class="label label-custom"><?php echo $this->lang->line('every_1_min'); ?></span> <i class="fa fa-question-circle text-primary"></i>
                            <?php }else{ ?>
                            <input name="checkInterval" type="hidden" value="5">
                            <span data-toggle="tooltip" data-html="true" data-placement="top" title="<?php echo $this->lang->line('pro_plan'); ?> : 1 minute"><span class="label label-custom"><?php echo $this->lang->line('every_5_min'); ?></span> <i class="fa fa-question-circle text-primary"></i></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label" for="name"><?php echo $this->lang->line('send_notifications'); ?></label>
                        <div class="col-md-11 col-md-offset-1">
                                <div class="checkbox checkbox-custom checkbox-circle">
                                    <input id="checkbox08" type="checkbox" value="1" name="email" checked disabled>
                                    <label for="checkbox08">
                                        <?php echo $userDetails[0]->email;?>
                                        <i class="fa fa-envelope text-custom"></i>
                                    </label>
                                </div>
                            <?php if($_SESSION['user_profile_premium']){ ?>
                            <div class="checkbox checkbox-custom checkbox-circle">
                                <input id="checkbox09" type="checkbox" name="" value="0" <?php if($userDetails[0]->phoneNumber != null){echo "checked";}?>/>
                                <?php  if($userDetails[0]->phoneNumber != null){ ?>
                                        <label for="checkbox09">
                                        <?php echo "+".$userDetails[0]->countryCode." ".ltrim($userDetails[0]->phoneNumber,'0'); ?>
                                        <i class="fa fa-commenting text-custom"></i>
                                        </label>
                                <a href="<?php echo site_url('Settings');?>">(<?php echo $userDetails[0]->smsCount;?> sms left)</a>
                                <?php }?>
                            </div>
                            <?php foreach($contacts as $contact){?>
                            <div class="checkbox checkbox-custom checkbox-circle">
                                <input id="<?php echo $contact->address;?>" type="checkbox" value="<?php echo $contact->id;?>" name="contact[]" class="<?php echo $contact->type;?>">
                                <label for="<?php echo $contact->address;?>">
                                    <?php echo $contact->address;?>
                                    <i class="fa fa-envelope text-custom"></i>
                                </label>
                            </div>
                            <?php } ?>
                            <p><?php echo $this->lang->line('new_contact'); ?> <a href="<?php echo site_url('Settings');?>"><?php echo $this->lang->line('settings'); ?></a>.</p>
                            <?php }else { ?>
                            <div class="alert alert-info">
                                Souscrivez au <a class="text-info" href="<?php echo site_url("Payment")?>"><strong>forfait Premium <i class="fa fa-arrow-circle-up"></i></strong></a> pour activer les alertes par SMS.
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-default"><?php echo $this->lang->line('monitoring'); ?></button>
            </form>
        </div>
        <!-- form end -->
    </div>
    <div class="col-md-6">
        <div class="well-block">
            <div class="well-title">
                <h2>We monitor your website</h2>
            </div>
            <div class="feature-block">
                <div class="feature feature-blurb-text">
                    <h4 class="feature-title">24/7 Hours Available</h4>
                    <div class="feature-content">
                        <p>Integer nec nisi sed mi hendrerit mattis. Vestibulum mi nunc, ultricies quis vehicula et, iaculis in magnestibulum.</p>
                    </div>
                </div>
                <div class="feature feature-blurb-text">
                    <h4 class="feature-title">Experienced Staff Available</h4>
                    <div class="feature-content">
                        <p>Aliquam sit amet mi eu libero fermentum bibendum pulvinar a turpis. Vestibulum quis feugiat risus. </p>
                    </div>
                </div>
                <div class="feature feature-blurb-text">
                    <h4 class="feature-title">Low Price & Fees</h4>
                    <div class="feature-content">
                        <p>Praesent eu sollicitudin nunc. Cras malesuada vel nisi consequat pretium. Integer auctor elementum nulla suscipit in.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>