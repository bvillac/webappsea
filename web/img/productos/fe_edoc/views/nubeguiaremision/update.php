<?php
/* @var $this NubeGuiaRemisionController */
/* @var $model NubeGuiaRemision */

$this->breadcrumbs=array(
	'Nube Guia Remisions'=>array('index'),
	$model->IdGuiaRemision=>array('view','id'=>$model->IdGuiaRemision),
	'Update',
);

$this->menu=array(
	array('label'=>'List NubeGuiaRemision', 'url'=>array('index')),
	array('label'=>'Create NubeGuiaRemision', 'url'=>array('create')),
	array('label'=>'View NubeGuiaRemision', 'url'=>array('view', 'id'=>$model->IdGuiaRemision)),
	array('label'=>'Manage NubeGuiaRemision', 'url'=>array('admin')),
);
?>

<h1>Update NubeGuiaRemision <?php echo $model->IdGuiaRemision; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>