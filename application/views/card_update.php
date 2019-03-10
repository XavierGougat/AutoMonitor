<div class="row">
    <div class="well col-md-8 col-md-offset-2">
        <form role="form" action="<?php echo site_url('Settings/newCard');?>" method="POST" id="payment-form">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="text-white">
                        <i class="fa fa-lock"></i> Secured
                        <i class="fa fa-cc-jcb fa-2x pull-right"></i>
                        <i class="fa fa-cc-diners-club fa-2x pull-right"></i>
                        <i class="fa fa-cc-amex fa-2x pull-right"></i>
                        <i class="fa fa-cc-mastercard fa-2x pull-right"></i>
                        <i class="fa fa-cc-visa fa-2x pull-right"></i>
                        
                        
                    </span>
                </div>
                <div class="panel-body">
                    <p class="payment-errors label label-danger"></p>
                    <div class="form-group">
                        <label for="cardName">
                            CARD NAME</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Full name  (as indicated on your credit card)"
                                   required />
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardNumber">
                            CARD NUMBER</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cooptr-card" placeholder="Valid card number"
                                   required data-stripe="number"/>
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <label for="cvCode">
                                EXPIRATION DATE
                            </label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <label for="cvCode" data-toggle="tooltip" data-placement="top" title="3 or 4 last digits behind your card.">
                                CVC <i class="fa fa-question-circle text-primary"></i>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-md-3">
                            <input type="text" class="form-control" placeholder="MM" required data-stripe="exp_month"/>      
                        </div>
                        <div class="col-xs-3 col-md-3">
                            <input type="text" class="form-control" placeholder="AAAA" required data-stripe="exp_year"/>
                        </div>
                        <div class="col-xs-6 col-md-6 pull-right">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="3 or 4 digits" required data-stripe="cvc"/>
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" id="button-pay" class="pull-right btn btn-primary btn-lg"><i id="label-pay" class="fa fa-check-circle text-custom"></i> Update card</button>
                </div>
            </div>
        </form> 
    </div>
</div>