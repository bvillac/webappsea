<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$perId=0;
$usuId=0;
//echo $actividad;
if($actividad){
    $session = Yii::$app->session;
    $perId = $session->get('PB_perid', FALSE);
    $usuId = $session->get('PB_iduser', FALSE);
}
?>

<?= Html::hiddenInput('txth_usu_id',$usuId,['id' =>'txth_usu_id']); ?>
<?= Html::hiddenInput('txth_per_id',$perId,['id' =>'txth_per_id']); ?>

<div class="col-sm-9 padding-right">
    <?php if($actividad){ ?>
        <?= $this->render('_confirmar-datos-activo.php', ['actividad' => $actividad,'Data' => $Data]) ?> 
    <?php }else{ ?>        
        <?= $this->render('_confirmar-datos-inactivo.php', ['actividad' => $actividad]) ?> 
    <?php } ?>
</div>
<div class="col-sm-3 padding-right">
    <?= $this->render('_confirmar-datos-rigth.php') ?>  			
</div>
