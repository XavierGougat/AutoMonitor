<div class="row">
    <div class="col-md-12">
        <p>You will received an email to <?php echo $email;?> with a verification code.<p>
        <p>Please enter below the code you received to confirm that you are the account owner.</p>
        <form action="<?php echo site_url('Settings/confirmVerificationCode/'.$change)?>" method="post">
            <label for="verificationCode">Verification Code <i class="fa fa-asterisk text-danger" title="required"></i></label>
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control" required type="text" style="text-transform:uppercase;" maxlength="5" size="5" name="verificationCode" id="verificationCode"/>
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-check"></i></button>
                    <a href="<?php echo site_url('Settings');?>" class="btn btn-md btn-danger"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>