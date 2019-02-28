<?php
/* @var $this NubeRetencionController */
/* @var $model NubeRetencion */

$this->breadcrumbs=array(
	'Nube Retencions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NubeRetencion', 'url'=>array('index')),
	array('label'=>'Manage NubeRetencion', 'url'=>array('admin')),
);
?>

<h1>Create NubeRetencion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>