<div class="row">
    <div class="col-md-12">
        <h4>Mon abonnement</h4>
        <div class="well">
            <?php if(!empty($subscriptions['data'][0]['status'])){ ?>
            <h4><span class="label label-primary">Forfait <?php echo $subscriptions['data'][0]['plan']['name']." à ".number_format($subscriptions['data'][0]['plan']['amount']/100,2)."€/mois"; ?></span>
            </h4>
            <?php if($subscriptions['data'][0]['cancel_at_period_end']==false){ ?>
            <p><strong><?php echo "Prochaine facturation le ".date('d/m/Y',$subscriptions['data'][0]['current_period_end']);?></strong></p>
            <?php }else {?>
            <p><strong><?php echo "Votre abonnement se terminera le ".date('d/m/Y',$subscriptions['data'][0]['current_period_end']);?></strong></p>
            <?php } ?>
            <?php if($subscriptions['data'][0]['cancel_at_period_end']==false){ ?>
            <p><a href="<?php echo site_url('/Payment/cancelSubscription');?>"><button id="resiliation" class="btn btn-xs btn-danger">Résilier l'abonnement</button></a></p>
            <?php }else{ ?>
            <p><a href="<?php echo site_url().'/Payment/reactiveSubscription';?>"><button class="btn btn-xs btn-custom">Ré-activer l'abonnement</button></a></p>
            <?php } ?>
            <p style="font-size:10px;color:grey;">Les frais d'abonnement sont facturés au début de chaque période.<br />Il est possible que vous deviez attendre quelques jours après la date de facturation avant que ces frais n'apparaissent sur votre compte.</p>
            <?php }else { ?>
            <p style="font-size:10px;color:grey;">Aucun abonnement actif en cours.</p>
            <?php } ?>
        </div>
    </div>
</div>
<h4>Mes factures</h4>
<div class="well table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Période de service</th>
                <th>Montant facture</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($invoices['data'] as $invoice){
            ?>
            <tr>
                <th scope="row"><i class="fa fa-clock-o" style="font-size:11px;"> <?php echo "Du ".date('d/m/Y',$invoice['lines']['data'][0]['period']['start']).' au '.date('d/m/Y',$invoice['lines']['data'][0]['period']['end']);?></i></th>
                <td><?php echo number_format($invoice['total']/100,2)." ".$invoice['currency'];?></td>
                <td><span class=""><?php if($invoice['paid']==true){echo "Payé <i class='fa fa-check'></i>";}?></span></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>