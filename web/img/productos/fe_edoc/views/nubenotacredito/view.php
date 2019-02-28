<?php
/* @var $this NubeNotaCreditoController */
/* @var $model NubeNotaCredito */

$this->breadcrumbs=array(
	'Nube Nota Creditos'=>array('index'),
	$model->IdNotaCredito,
);

$this->menu=array(
	array('label'=>'List NubeNotaCredito', 'url'=>array('index')),
	array('label'=>'Create NubeNotaCredito', 'url'=>array('create')),
	array('label'=>'Update NubeNotaCredito', 'url'=>array('update', 'id'=>$model->IdNotaCredito)),
	array('label'=>'Delete NubeNotaCredito', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->IdNotaCredito),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NubeNotaCredito', 'url'=>array('admin')),
);
?>

<h1>View NubeNotaCredito #<?php echo $model->IdNotaCredito; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'IdNotaCredito',
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
		'FechaEmision',
		'DireccionEstablecimiento',
		'ContribuyenteEspecial',
		'ObligadoContabilidad',
		'TipoIdentificacionComprador',
		'RazonSocialComprador',
		'IdentificacionComprador',
		'Rise',
		'CodDocModificado',
		'NumDocModificado',
		'FechaEmisionDocModificado',
		'TotalSinImpuesto',
		'ValorModificacion',
		'MotivoModificacion',
		'Moneda',
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
		'CodigoTransaccionERP',
	),
)); ?>
