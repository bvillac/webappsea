<?php
/* @var $this NubeRetencionController */
/* @var $data NubeRetencion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdRetencion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->IdRetencion), array('view', 'id'=>$data->IdRetencion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AutorizacionSRI')); ?>:</b>
	<?php echo CHtml::encode($data->AutorizacionSRI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FechaAutorizacion')); ?>:</b>
	<?php echo CHtml::encode($data->FechaAutorizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Ambiente')); ?>:</b>
	<?php echo CHtml::encode($data->Ambiente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TipoEmision')); ?>:</b>
	<?php echo CHtml::encode($data->TipoEmision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RazonSocial')); ?>:</b>
	<?php echo CHtml::encode($data->RazonSocial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NombreComercial')); ?>:</b>
	<?php echo CHtml::encode($data->NombreComercial); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Ruc')); ?>:</b>
	<?php echo CHtml::encode($data->Ruc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ClaveAcceso')); ?>:</b>
	<?php echo CHtml::encode($data->ClaveAcceso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CodigoDocumento')); ?>:</b>
	<?php echo CHtml::encode($data->CodigoDocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PuntoEmision')); ?>:</b>
	<?php echo CHtml::encode($data->PuntoEmision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Establecimiento')); ?>:</b>
	<?php echo CHtml::encode($data->Establecimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Secuencial')); ?>:</b>
	<?php echo CHtml::encode($data->Secuencial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DireccionMatriz')); ?>:</b>
	<?php echo CHtml::encode($data->DireccionMatriz); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FechaEmision')); ?>:</b>
	<?php echo CHtml::encode($data->FechaEmision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DireccionEstablecimiento')); ?>:</b>
	<?php echo CHtml::encode($data->DireccionEstablecimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContribuyenteEspecial')); ?>:</b>
	<?php echo CHtml::encode($data->ContribuyenteEspecial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ObligadoContabilidad')); ?>:</b>
	<?php echo CHtml::encode($data->ObligadoContabilidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TipoIdentificacionSujetoRetenido')); ?>:</b>
	<?php echo CHtml::encode($data->TipoIdentificacionSujetoRetenido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdentificacionSujetoRetenido')); ?>:</b>
	<?php echo CHtml::encode($data->IdentificacionSujetoRetenido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RazonSocialSujetoRetenido')); ?>:</b>
	<?php echo CHtml::encode($data->RazonSocialSujetoRetenido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PeriodoFiscal')); ?>:</b>
	<?php echo CHtml::encode($data->PeriodoFiscal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TotalRetencion')); ?>:</b>
	<?php echo CHtml::encode($data->TotalRetencion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UsuarioCreador')); ?>:</b>
	<?php echo CHtml::encode($data->UsuarioCreador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmailResponsable')); ?>:</b>
	<?php echo CHtml::encode($data->EmailResponsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EstadoDocumento')); ?>:</b>
	<?php echo CHtml::encode($data->EstadoDocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DescripcionError')); ?>:</b>
	<?php echo CHtml::encode($data->DescripcionError); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CodigoError')); ?>:</b>
	<?php echo CHtml::encode($data->CodigoError); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DirectorioDocumento')); ?>:</b>
	<?php echo CHtml::encode($data->DirectorioDocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NombreDocumento')); ?>:</b>
	<?php echo CHtml::encode($data->NombreDocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GeneradoXls')); ?>:</b>
	<?php echo CHtml::encode($data->GeneradoXls); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SecuencialERP')); ?>:</b>
	<?php echo CHtml::encode($data->SecuencialERP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CodigoTransaccionERP')); ?>:</b>
	<?php echo CHtml::encode($data->CodigoTransaccionERP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Estado')); ?>:</b>
	<?php echo CHtml::encode($data->Estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FechaCarga')); ?>:</b>
	<?php echo CHtml::encode($data->FechaCarga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdLote')); ?>:</b>
	<?php echo CHtml::encode($data->IdLote); ?>
	<br />

	*/ ?>

</div>