<?php
/**
 * Este Archivo contiene las vista de Compañias
 * @author Ing. Byron Villacreses <byronvillacreses@gmail.com>
 * @copyright Copyright &copy; SolucionesVillacreses 2014-09-24
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

?>
<?php //echo $this->render('_include'); ?>
<div class="col-lg-12">
    <?= $this->render('_frm_BuscarGrid', array('model' => $model, 'tipoDoc' => $tipoDoc,'tipoApr'=> $tipoApr)); ?>
</div>
<div class="col-lg-12">
    <?= $this->render('_indexGrid', array('model' => $model)); ?>
</div>
