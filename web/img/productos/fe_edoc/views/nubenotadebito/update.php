<?php
/* @var $this NubeNotaDebitoController */
/* @var $model NubeNotaDebito */

$this->breadcrumbs=array(
	'Nube Nota Debitos'=>array('index'),
	$model->IdNotaDebito=>array('view','id'=>$model->IdNotaDebito),
	'Update',
);

$this->menu=array(
	array('label'=>'List NubeNotaDebito', 'url'=>array('index')),
	array('label'=>'Create NubeNotaDebito', 'url'=>array('create')),
	array('label'=>'View NubeNotaDebito', 'url'=>array('view', 'id'=>$model->IdNotaDebito)),
	array('label'=>'Manage NubeNotaDebito', 'url'=>array('admin')),
);
?>

<h1>Update NubeNotaDebito <?php echo $model->IdNotaDebito; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>