<?php
/* @var $this NubeGuiaRemisionController */
/* @var $model NubeGuiaRemision */

$this->breadcrumbs=array(
	'Nube Guia Remisions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NubeGuiaRemision', 'url'=>array('index')),
	array('label'=>'Manage NubeGuiaRemision', 'url'=>array('admin')),
);
?>

<h1>Create NubeGuiaRemision</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>