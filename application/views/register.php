<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="wrapper-page">
                    <div class="m-t-40 card-box">
                        <i class="fa fa-lock text-primary pull-right" title="<?php echo $this->lang->line('secured'); ?>"></i>
                        <div class="text-center">
                            <h2 class="text-uppercase m-t-0 m-b-30">
                                <span class="logo" style="margin-left:13px;">
                                    Aut<i class="fa fa-check-circle-o text-primary"></i>Monitor<span style="font-size:10px;">.io</span>
                                </span>
                            </h2>
                            <?php if(validation_errors()!=null){?>
                            <div class="alert alert-danger">
                                <?php echo validation_errors(); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="account-content">
                            <form class="form-horizontal" method="post" action="<?php echo site_url('Visitor/Register');?>">
                                <div class="form-group m-b-20">
                                    <div class="col-xs-12">
                                        <label for="name"><?php echo $this->lang->line('full_name'); ?> <i class="fa fa-asterisk text-danger" title="<?php echo $this->lang->line('required'); ?>"></i></label>
                                        <input class="form-control" required id="name" name="name" value="<?php if(set_value('name')!=null){echo set_value('name');}?>" placeholder="<?php echo $this->lang->line('full_name_placeholder'); ?>" tabindex="1">
                                    </div>
                                </div>
                                <div class="form-group m-b-20">
                                    <div class="col-xs-12">
                                        <label class="required" for="emailaddress"><?php echo $this->lang->line('email_address'); ?> <i class="fa fa-asterisk text-danger" title="<?php echo $this->lang->line('required'); ?>"></i></label>
                                        <input class="form-control" type="email" id="emailaddress" name="email" required value="<?php if(set_value('email')!=null){echo set_value('email');}?>" placeholder="<?php echo $this->lang->line('email_address_placeholder'); ?>" tabindex="2">
                                    </div>
                                </div>
                                <div class="form-group m-b-20">
                                    <div class="col-xs-12">
                                        <label for="password"><?php echo $this->lang->line('password'); ?> <i class="fa fa-asterisk text-danger" title="<?php echo $this->lang->line('required'); ?>"></i></label>
                                        <input class="form-control" type="password" required id="password" name="password" placeholder="<?php echo $this->lang->line('password_placeholder'); ?>" tabindex="3">
                                    </div>
                                </div>
                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-xs-12">
                                        <button tabindex="4" class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('sign_up'); ?></button>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-white"><?php echo $this->lang->line('already'); ?> <a class="btn btn-xs btn-primary" href="<?php echo site_url('Visitor/Login')?>"><u><?php echo $this->lang->line('sign_in'); ?></u></a></p>
                        </div>
                    </div>
                </div>
                <!-- end wrapper -->
            </div>
        </div>
    </div>
</section>
