<?php
/* @var $this NubeRetencionController */
/* @var $model NubeRetencion */

$this->breadcrumbs=array(
	'Nube Retencions'=>array('index'),
	$model->IdRetencion,
);

$this->menu=array(
	array('label'=>'List NubeRetencion', 'url'=>array('index')),
	array('label'=>'Create NubeRetencion', 'url'=>array('create')),
	array('label'=>'Update NubeRetencion', 'url'=>array('update', 'id'=>$model->IdRetencion)),
	array('label'=>'Delete NubeRetencion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->IdRetencion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NubeRetencion', 'url'=>array('admin')),
);
?>

<h1>View NubeRetencion #<?php echo $model->IdRetencion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'IdRetencion',
		'AutorizacionSRI',
		'FechaAutorizacion',
		'Ambiente',
		'TipoEmision',
		'RazonSocial',
		'NombreComercial',
		'Ruc',
		'ClaveAcceso',
		'CodigoDocumento',
		'PuntoEmision',
		'Establecimiento',
		'Secuencial',
		'DireccionMatriz',
		'FechaEmision',
		'DireccionEstablecimiento',
		'ContribuyenteEspecial',
		'ObligadoContabilidad',
		'TipoIdentificacionSujetoRetenido',
		'IdentificacionSujetoRetenido',
		'RazonSocialSujetoRetenido',
		'PeriodoFiscal',
		'TotalRetencion',
		'UsuarioCreador',
		'EmailResponsable',
		'EstadoDocumento',
		'DescripcionError',
		'CodigoError',
		'DirectorioDocumento',
		'NombreDocumento',
		'GeneradoXls',
		'SecuencialERP',
		'CodigoTransaccionERP',
		'Estado',
		'FechaCarga',
		'IdLote',
	),
)); ?>
