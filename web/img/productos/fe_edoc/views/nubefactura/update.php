<?php
/* @var $this NubeFacturaController */
/* @var $model NubeFactura */

$this->breadcrumbs=array(
	'Nube Facturas'=>array('index'),
	$model->IdFactura=>array('view','id'=>$model->IdFactura),
	'Update',
);

$this->menu=array(
	array('label'=>'List NubeFactura', 'url'=>array('index')),
	array('label'=>'Create NubeFactura', 'url'=>array('create')),
	array('label'=>'View NubeFactura', 'url'=>array('view', 'id'=>$model->IdFactura)),
	array('label'=>'Manage NubeFactura', 'url'=>array('admin')),
);
?>

<h1>Update NubeFactura <?php echo $model->IdFactura; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>