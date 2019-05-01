<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>



<div class="col-sm-9 padding-right">
    <?= $this->render('_confirmar-datos.php', ['directoryAsset' => $directoryAsset, 'model' => $model]) ?>  			
</div>
<div class="col-sm-3 padding-right">
    <?= $this->render('_confirmar-datos-rigth.php') ?>  			
</div>
