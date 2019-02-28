<?php
/* @var $this NubeNotaCreditoController */
/* @var $model NubeNotaCredito */

$this->breadcrumbs=array(
	'Nube Nota Creditos'=>array('index'),
	$model->IdNotaCredito=>array('view','id'=>$model->IdNotaCredito),
	'Update',
);

$this->menu=array(
	array('label'=>'List NubeNotaCredito', 'url'=>array('index')),
	array('label'=>'Create NubeNotaCredito', 'url'=>array('create')),
	array('label'=>'View NubeNotaCredito', 'url'=>array('view', 'id'=>$model->IdNotaCredito)),
	array('label'=>'Manage NubeNotaCredito', 'url'=>array('admin')),
);
?>

<h1>Update NubeNotaCredito <?php echo $model->IdNotaCredito; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>