<div class="row">
    <div class="well col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <address>
                    <strong>Aut<i class="fa fa-check-circle-o text-primary"></i>Monitor.<span style="font-size:10px" class="text-primary">io</span></strong><br>
                    SIREN : en cours d'immatriculation<br>
                    Immatriculé au RCS de Vannes<br>
                    <abbr title="Contact téléphonique">Tel.</abbr> (+33) 6 27 74 01 07
                </address>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                <p>
                    <em><?php echo date('d/m/Y');?></em>
                </p>
                <p>
                    <em><?php echo $this->lang->line('subscription'); ?> #<?php echo date('y').sprintf("%03d",intval(date('z'))+1).chr(64 + intval($invoiceNumber[0]['count'])+1);?></em>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                <h1><?php echo $this->lang->line('subscribe'); ?></h1>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('subscription'); ?></th>
                        <th><?php echo $this->lang->line('charge'); ?></th>
                        <th class="text-center"><?php echo $this->lang->line('price'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-md-8"><em><?php echo $this->lang->line('monthly_subscription'); ?> Automonitor.io</em></td>
                        <td class="col-md-2 text-right"><?php echo $this->lang->line('monthly'); ?></td>
                        <td class="col-md-2 text-center">€ 4.90</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right"><abbr title="Art. 293B du CGI"><?php echo $this->lang->line('vat_free'); ?></abbr></td>
                        <td class="text-center text-muted">€ 0.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right"><h4><strong>Total</strong></h4></td>
                        <td class="text-center text-primary"><h4><strong>€4.90</strong></h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <form role="form" action="<?php echo site_url('Payment/Charge');?>" method="POST" id="payment-form">
            <input type="hidden" name="invoiceNumber" value="<?php echo date('y').sprintf("%03d",intval(date('z'))+1).chr(64 + intval($invoiceNumber[0]['count'])+1);?>" />
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="text-white">
                        <i class="fa fa-lock"></i> <?php echo $this->lang->line('secured'); ?>
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
                            <?php echo $this->lang->line('card_name'); ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardName" name="cardName" placeholder="<?php echo $this->lang->line('card_name_placeholder'); ?>"
                                   required />
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardNumber">
                            <?php echo $this->lang->line('card_number'); ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cooptr-card" placeholder="<?php echo $this->lang->line('card_number_placeholder'); ?>"
                                   required data-stripe="number"/>
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <label for="cvCode">
                                <?php echo $this->lang->line('expiraton_date'); ?>
                            </label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <label for="cvCode" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('cvc_title'); ?>">
                                <?php echo $this->lang->line('cvc'); ?> <i class="fa fa-question-circle text-primary"></i>
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
                                <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('cvc_placeholder'); ?>" required data-stripe="cvc"/>
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" id="button-pay" class="pull-right btn btn-primary btn-lg"><i id="label-pay" class="fa fa-check-circle text-custom"></i> <?php echo $this->lang->line('pay'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>