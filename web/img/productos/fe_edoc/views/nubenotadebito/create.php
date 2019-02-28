<?php
/* @var $this NubeNotaDebitoController */
/* @var $model NubeNotaDebito */

$this->breadcrumbs=array(
	'Nube Nota Debitos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NubeNotaDebito', 'url'=>array('index')),
	array('label'=>'Manage NubeNotaDebito', 'url'=>array('admin')),
);
?>

<h1>Create NubeNotaDebito</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>