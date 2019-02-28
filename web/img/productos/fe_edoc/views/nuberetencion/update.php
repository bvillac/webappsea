<?php
/* @var $this NubeRetencionController */
/* @var $model NubeRetencion */

$this->breadcrumbs=array(
	'Nube Retencions'=>array('index'),
	$model->IdRetencion=>array('view','id'=>$model->IdRetencion),
	'Update',
);

$this->menu=array(
	array('label'=>'List NubeRetencion', 'url'=>array('index')),
	array('label'=>'Create NubeRetencion', 'url'=>array('create')),
	array('label'=>'View NubeRetencion', 'url'=>array('view', 'id'=>$model->IdRetencion)),
	array('label'=>'Manage NubeRetencion', 'url'=>array('admin')),
);
?>

<h1>Update NubeRetencion <?php echo $model->IdRetencion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>