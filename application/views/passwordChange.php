<div class="row">
    <div class="col-xs-12">
        <form class="form-horizontal" action="<?php echo site_url('Settings/updatePassword')?>" method="post">
            <div class="form-group m-b-20">
                <div class="col-xs-6">
                    <label for="password">New Password <i class="fa fa-asterisk text-danger" title="required"></i></label>
                    <input class="form-control" required type="password" name="password" id="password"/>
                </div>
            </div>
            <div class="form-group m-b-20">
                <div class="col-xs-6">
                    <label for="passwordConfirm">Confirm New Password <i class="fa fa-asterisk text-danger" title="required"></i></label>
                    <input class="form-control" required type="password" name="passwordConfirm" id="passwordConfirm"/>
                </div>
            </div>
            <div class="form-group m-b-20">
                <div class="col-xs-6">
                    <p>
                        <button type="submit" class="btn btn-md btn-primary">Update <i class="fa fa-check"></i></button>
                        <a href="<?php echo site_url('Settings');?>" class="btn btn-md btn-danger">Cancel <i class="fa fa-undo"></i></a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>