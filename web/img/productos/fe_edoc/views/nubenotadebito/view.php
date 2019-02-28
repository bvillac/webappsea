<?php
/* @var $this NubeNotaDebitoController */
/* @var $model NubeNotaDebito */

$this->breadcrumbs=array(
	'Nube Nota Debitos'=>array('index'),
	$model->IdNotaDebito,
);

$this->menu=array(
	array('label'=>'List NubeNotaDebito', 'url'=>array('index')),
	array('label'=>'Create NubeNotaDebito', 'url'=>array('create')),
	array('label'=>'Update NubeNotaDebito', 'url'=>array('update', 'id'=>$model->IdNotaDebito)),
	array('label'=>'Delete NubeNotaDebito', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->IdNotaDebito),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NubeNotaDebito', 'url'=>array('admin')),
);
?>

<h1>View NubeNotaDebito #<?php echo $model->IdNotaDebito; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'IdNotaDebito',
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
		'ValorTotal',
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
