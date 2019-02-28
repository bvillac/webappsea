<?php
/* @var $this NubeGuiaRemisionController */
/* @var $model NubeGuiaRemision */

$this->breadcrumbs=array(
	'Nube Guia Remisions'=>array('index'),
	$model->IdGuiaRemision,
);

$this->menu=array(
	array('label'=>'List NubeGuiaRemision', 'url'=>array('index')),
	array('label'=>'Create NubeGuiaRemision', 'url'=>array('create')),
	array('label'=>'Update NubeGuiaRemision', 'url'=>array('update', 'id'=>$model->IdGuiaRemision)),
	array('label'=>'Delete NubeGuiaRemision', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->IdGuiaRemision),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NubeGuiaRemision', 'url'=>array('admin')),
);
?>

<h1>View NubeGuiaRemision #<?php echo $model->IdGuiaRemision; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'IdGuiaRemision',
		'AutorizacionSRI',
		'FechaAutorizacion',
		'Ambiente',
		'TipoEmision',
		'RazonSocial',
		'NombreComercial',
		'Ruc',
		'ClaveAcceso',
		'CodigoDocumento',
		'Establecimiento',
		'PuntoEmision',
		'Secuencial',
		'DireccionMatriz',
		'DireccionEstablecimiento',
		'DireccionPartida',
		'RazonSocialTransportista',
		'TipoIdentificacionTransportista',
		'IdentificacionTransportista',
		'Rise',
		'ObligadoContabilidad',
		'ContribuyenteEspecial',
		'FechaInicioTransporte',
		'FechaFinTransporte',
		'Placa',
		'UsuarioCreador',
		'EmailResponsable',
		'EstadoDocumento',
		'DescripcionError',
		'CodigoError',
		'DirectorioDocumento',
		'NombreDocumento',
		'GeneradoXls',
		'SecuencialERP',
		'Estado',
		'IdLote',
	),
)); ?>
