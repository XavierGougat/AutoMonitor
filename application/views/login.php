<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="wrapper-page">
                    <div class="m-t-40 card-box">
                        <i class="fa fa-lock text-primary pull-right" title="Secured form"></i>
                        <div class="text-center">
                            <h2 class="text-uppercase m-t-0 m-b-30">
                                <span class="logo" style="margin-left:13px;">
                                    Aut<i class="fa fa-check-circle-o text-primary"></i>Monitor<span style="font-size:10px;">.io</span>
                                </span>
                            </h2>
                            <?php if(isset($_SESSION['messageKO'])){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['messageKO']; ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="account-content">
                            <form class="form-horizontal" method="POST" action="<?php echo site_url('Visitor/Signin');?>">
                                <div class="form-group m-b-20">
                                    <div class="col-xs-12">
                                        <label for="email"><?php echo $this->lang->line('email_address'); ?></label>
                                        <input class="form-control" type="text" id="emailaddress" name="email" required value="<?php if(set_value('email')!=null){echo set_value('email');}?>" placeholder="<?php echo $this->lang->line('email_address_placeholder'); ?>" autocomplete="home email" tabindex="1">
                                    </div>
                                </div>
                                <div class="form-group m-b-20">
                                    <div class="col-xs-12">
                                        <a href="<?php echo site_url('Visitor/Password')?>" class="text-muted pull-right font-14"><?php echo $this->lang->line('forgot_password'); ?></a>
                                        <label for="password"><?php echo $this->lang->line('password'); ?></label>
                                        <input class="form-control" type="password" required id="password" name="password" placeholder="<?php echo $this->lang->line('password_placeholder'); ?>" autocomplete="on" tabindex="2">
                                    </div>
                                </div>
                                <div class="form-group m-b-30">
                                    <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                            <input id="checkbox5" type="checkbox" name="remember_me" value="OK">
                                            <label for="checkbox5">
                                                <?php echo $this->lang->line('remember_me'); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-xs-12">
                                        <button tabindex="3" class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('sign_in'); ?></button>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- end card-box-->
                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-white"><?php echo $this->lang->line('no_account'); ?> <a class="btn btn-xs btn-primary" href="<?php echo site_url('Visitor/Signup')?>"><u><?php echo $this->lang->line('sign_up'); ?></u></a></p>
                        </div>
                    </div>
                </div>
                <!-- end wrapper -->
            </div>
        </div>
    </div>
</section>