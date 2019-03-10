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
                            <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                        </div>
                        <div class="account-content">
                            <div class="text-center m-b-20">
                                <p class="text-muted m-b-0 line-h-24">Enter your email address and we'll send you an email with instructions to reset your password.  </p>
                            </div>
                            <form class="form-horizontal" method="post" action="<?php echo site_url('Visitor/updateCredentials')?>">
                                <div class="form-group m-b-20">
                                    <div class="col-xs-12">
                                        <label for="emailaddress">Email address <i class="fa fa-asterisk text-danger" title="required"></i></label>
                                        <input class="form-control" type="email" name="email" id="emailAddress" required="" placeholder="john@doe.com">
                                    </div>
                                </div>
                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-xs-12">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- end card-box-->
                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">Back to <a href="<?php echo site_url('Visitor/Login');?>" class="text-dark m-l-5">Sign In</a></p>
                        </div>
                    </div>
                </div>
                <!-- end wrapper -->
            </div>
        </div>
    </div>
</section>