<?php if(!$_SESSION['user_profile_premium']){?>
<div class="alert alert-info">
    Souscrivez au <a class="text-info" href="<?php echo site_url("Payment")?>"><strong>forfait Premium <i class="fa fa-arrow-circle-up"></i></strong></a> afin de bénéficier de la totalité des services Automonir.io
</div>
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <?php if($_SESSION['user_profile_premium']){?>
        <h5><?php echo $this->lang->line('plan_subscription'); ?></h5>
        <div class="well">
            <p>
                <kbd style="background-color:rgb(103,106,108);"><?php echo $userDetails[0]->email;?></kbd><br>
                <i class="fa fa-2x fa-cc-<?php echo strtolower($userDetails[0]->cardBrand);?>"></i> 
                <strong><?php
                                                if($userDetails[0]->cardBrand=="amex"){
                                                    echo "&nbsp;&nbsp;&nbsp;••••&nbsp;&nbsp;&nbsp;••••••&nbsp;&nbsp;&nbsp;•";
                                                }else{
                                                    if($userDetails[0]->cardBrand=="diners-club"){
                                                        echo "&nbsp;&nbsp;&nbsp;••••&nbsp;&nbsp;&nbsp;••••&nbsp;&nbsp;&nbsp;••";
                                                    }
                                                    else{
                                                        echo "&nbsp;&nbsp;&nbsp;••••&nbsp;&nbsp;&nbsp;••••&nbsp;&nbsp;&nbsp;••••&nbsp;&nbsp;&nbsp;";
                                                    }
                                                }
                                                echo sprintf("%04d", $userDetails[0]->cardLast4);
                    ?></strong>
                <a class="pull-right" href="<?php echo site_url('Settings/cardUpdate')?>"><u><?php echo $this->lang->line('update_card'); ?></u></a>
            </p>
            <p style="font-size:12px;">
                <?php 
                if(!empty($subscriptions['data'][0]['status'])){
                    if($subscriptions['data'][0]['cancel_at_period_end']==false){ ?>
                <strong><?php echo $this->lang->line('next_charge')." : ";?></strong>
                <?php echo date('d F Y',$subscriptions['data'][0]['current_period_end']);?>
                <?php }else {?>
                <strong><?php echo $this->lang->line('subscription_end_date')." "; ?></strong><?php echo date('d F Y',$subscriptions['data'][0]['current_period_end']);?>
                <?php }
                }
                else{
                    echo "Aucun abonnement actif en cours...";
                }
                ?>
                <a class="pull-right" href="<?php echo site_url('Payment/Invoices')?>"><u><?php echo $this->lang->line('see_invoices'); ?></u></a>
            </p>
            <hr>

            <?php if(!$_SESSION['user_profile_premium']){?>
            <p><strong><?php echo $this->lang->line('using'); ?> <span class="text-primary"><?php echo $this->lang->line('free_plan'); ?></span></strong>. <em><i class="fa fa-question-circle-o"></i> <?php echo $this->lang->line('free_plan_details'); ?></em></p>
            <p><a href="<?php echo site_url('Payment')?>" class="label label-primary"><?php echo $this->lang->line('upgrade_to_pro'); ?></a></p>
            <?php }else{ ?>
            <p><strong><?php echo $this->lang->line('using'); ?> <span class="text-primary"><?php echo $this->lang->line('pro_plan'); ?></span></strong>. <em><i class="fa fa-question-circle-o"></i> <?php echo $this->lang->line('pro_plan_details'); ?></em></p>
            <?php } ?>
        </div>
        <h5>Notifications</h5>
        <div class="well">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card-box">
                        <a href="<?php echo site_url('Payment/sms');?>" class="btn btn-sm btn-default pull-right"><?php echo $this->lang->line('add_sms'); ?></a>
                        <h6 class="text-muted m-t-0 text-uppercase"><?php echo $this->lang->line('sms_remaining'); ?></h6>
                        <h2 class="m-b-20"><span><?php echo $userDetails[0]->smsCount;?></span></h2>
                    </div>
                </div>
            </div>
            <div class="card-box">
                <h6 class="text-muted m-t-0 text-uppercase"><?php echo $this->lang->line('contact_list'); ?></h6>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <ul class="nav nav-tabs tabs-bordered">
                            <li class="active"><a data-toggle="tab" href="#mails"><i class="fa fa-envelope"></i> <?php echo $this->lang->line('mails'); ?></a></li>
                            <li><a data-toggle="tab" href="#phones"><i class="fa fa-phone"></i> <?php echo $this->lang->line('phones'); ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="mails" class="tab-pane fade in active">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p class="alert alert-info"><?php echo $this->lang->line('mails_are_free'); ?></p>
                                </div>
                                <form role="form" action="<?php echo site_url("Settings/addContact")?>" method="post">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <span class="text-danger"><?php echo form_error('address'); ?></span>
                                        <input type="hidden" name="type" value="mail">
                                        <div class="col-xs-9 col-sm-7 col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="address">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-custom" type="submit"><i class="fa fa-plus"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <ul class="list-group contactlist">
                                            <?php foreach($contacts as $contact) { 
                            if($contact->type=="mail"){?>
                                            <li class="list-group-item"><?php echo $contact->address;?> 
                                                <i id="<?php echo $contact->id;?>" class="fa fa-minus-circle text-danger deleteButton"></i>
                                            </li> 
                                            <?php }
                        }?> 
                                        </ul> 
                                    </div>
                            </div>
                            <div id="phones" class="tab-pane fade">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p class="alert alert-info"><?php echo $this->lang->line('sms_are_not_free'); ?></p>
                                </div>
                                <form role="form" action="<?php echo site_url("Settings/addContact")?>" method="post">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <span class="text-danger"><?php echo form_error('address'); ?></span>
                                        <input type="hidden" name="type" value="sms">
                                        <div class="col-xs-9 col-sm-7 col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="address">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-custom" type="submit"><i class="fa fa-plus"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <ul class="list-group contactlist">
                                        <?php foreach($contacts as $contact) { 
                        if($contact->type=="sms"){?>
                                        <li class="list-group-item"><?php echo $contact->address;?> 
                                            <i id="<?php echo $contact->id;?>" class="fa fa-minus-circle text-danger deleteButton"></i>
                                        </li> 
                                        <?php }
                    }?> 
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <h5><?php echo $this->lang->line('profile_informations'); ?></h5>
        <div class="well">
            <form action="<?php echo site_url('Settings/update');?>" method="POST">
                <div class="form-group">
                    <label for="name"><?php echo $this->lang->line('full_name'); ?></label>
                    <input type="text" value="<?php echo $userDetails[0]->name;?>" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email"><?php echo $this->lang->line('mail'); ?></label>
                    <input disabled type="text" name="email" value="<?php echo $userDetails[0]->email;?>" id="email" class="form-control">
                    <a class="btn btn-xs" href="<?php echo site_url('Settings/updateCredentials/email')?>"><?php echo $this->lang->line('update_my_mail'); ?></a>
                    <a class="btn btn-xs" href="<?php echo site_url('Settings/updateCredentials/password')?>"><?php echo $this->lang->line('update_my_password'); ?></a>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="countryCode"><?php echo $this->lang->line('country_code'); ?></label>
                            <select class="form-control" id="countryCode" name="countryCode">
                                <?php foreach($countryCodes as $countryCode){ ?>
                                <option data-countryCode="<?php echo $countryCode['countryCode'];?>" value="<?php echo $countryCode['indicativ'];?>" <?php if(empty($userDetails[0]->countryCode) && $countryCode['indicativ']=='33'){echo 'selected="selected"';} if($userDetails[0]->countryCode==$countryCode['indicativ']){echo 'selected="selected"';}?></option><?php echo $countryCode['label'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            <button class="btn btn-primary" type="submit"><?php echo $this->lang->line('submit'); ?></button>
            </form>
    </div>
</div>