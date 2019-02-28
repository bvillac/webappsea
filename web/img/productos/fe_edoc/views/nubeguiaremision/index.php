<?php
/**
 * Este Archivo contiene las vista de Guia de Remision
 * @author Ing. Byron Villacreses <byronvillacreses@gmail.com>
 * @copyright Copyright &copy; SolucionesVillacreses 2015-03-25
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
?>
<div class="col-lg-12">
    <?php echo $this->render('_frm_BuscarGrid', array('model' => $model, 'tipoDoc' => $tipoDoc,'tipoApr'=> $tipoApr)); ?>
</div>
<div class="col-lg-12">
    <?php echo $this->render('_indexGrid', array('model' => $model)); ?>
</div>