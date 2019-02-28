<?php
/* @var $this NubeNotaCreditoController */
/* @var $model NubeNotaCredito */

$this->breadcrumbs=array(
	'Nube Nota Creditos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NubeNotaCredito', 'url'=>array('index')),
	array('label'=>'Manage NubeNotaCredito', 'url'=>array('admin')),
);
?>

<h1>Create NubeNotaCredito</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>