<?php
/* @var $this NubeNotaCreditoController */
/* @var $model NubeNotaCredito */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nube-nota-credito-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'AutorizacionSRI'); ?>
		<?php echo $form->textField($model,'AutorizacionSRI',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'AutorizacionSRI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FechaAutorizacion'); ?>
		<?php echo $form->textField($model,'FechaAutorizacion'); ?>
		<?php echo $form->error($model,'FechaAutorizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Ambiente'); ?>
		<?php echo $form->textField($model,'Ambiente'); ?>
		<?php echo $form->error($model,'Ambiente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TipoEmision'); ?>
		<?php echo $form->textField($model,'TipoEmision'); ?>
		<?php echo $form->error($model,'TipoEmision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RazonSocial'); ?>
		<?php echo $form->textField($model,'RazonSocial',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'RazonSocial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NombreComercial'); ?>
		<?php echo $form->textField($model,'NombreComercial',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'NombreComercial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Ruc'); ?>
		<?php echo $form->textField($model,'Ruc',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'Ruc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ClaveAcceso'); ?>
		<?php echo $form->textField($model,'ClaveAcceso',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ClaveAcceso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CodigoDocumento'); ?>
		<?php echo $form->textField($model,'CodigoDocumento',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'CodigoDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Establecimiento'); ?>
		<?php echo $form->textField($model,'Establecimiento',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'Establecimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PuntoEmision'); ?>
		<?php echo $form->textField($model,'PuntoEmision',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'PuntoEmision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Secuencial'); ?>
		<?php echo $form->textField($model,'Secuencial',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'Secuencial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DireccionMatriz'); ?>
		<?php echo $form->textField($model,'DireccionMatriz',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'DireccionMatriz'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FechaEmision'); ?>
		<?php echo $form->textField($model,'FechaEmision'); ?>
		<?php echo $form->error($model,'FechaEmision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DireccionEstablecimiento'); ?>
		<?php echo $form->textField($model,'DireccionEstablecimiento',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'DireccionEstablecimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ContribuyenteEspecial'); ?>
		<?php echo $form->textField($model,'ContribuyenteEspecial'); ?>
		<?php echo $form->error($model,'ContribuyenteEspecial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ObligadoContabilidad'); ?>
		<?php echo $form->textField($model,'ObligadoContabilidad',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'ObligadoContabilidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TipoIdentificacionComprador'); ?>
		<?php echo $form->textField($model,'TipoIdentificacionComprador',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'TipoIdentificacionComprador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RazonSocialComprador'); ?>
		<?php echo $form->textField($model,'RazonSocialComprador',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'RazonSocialComprador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IdentificacionComprador'); ?>
		<?php echo $form->textField($model,'IdentificacionComprador',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'IdentificacionComprador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Rise'); ?>
		<?php echo $form->textField($model,'Rise',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'Rise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CodDocModificado'); ?>
		<?php echo $form->textField($model,'CodDocModificado',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'CodDocModificado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NumDocModificado'); ?>
		<?php echo $form->textField($model,'NumDocModificado',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'NumDocModificado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FechaEmisionDocModificado'); ?>
		<?php echo $form->textField($model,'FechaEmisionDocModificado'); ?>
		<?php echo $form->error($model,'FechaEmisionDocModificado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TotalSinImpuesto'); ?>
		<?php echo $form->textField($model,'TotalSinImpuesto',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'TotalSinImpuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ValorModificacion'); ?>
		<?php echo $form->textField($model,'ValorModificacion',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'ValorModificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MotivoModificacion'); ?>
		<?php echo $form->textField($model,'MotivoModificacion',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'MotivoModificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Moneda'); ?>
		<?php echo $form->textField($model,'Moneda',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'Moneda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UsuarioCreador'); ?>
		<?php echo $form->textField($model,'UsuarioCreador',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'UsuarioCreador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EmailResponsable'); ?>
		<?php echo $form->textField($model,'EmailResponsable',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'EmailResponsable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EstadoDocumento'); ?>
		<?php echo $form->textField($model,'EstadoDocumento',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'EstadoDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DescripcionError'); ?>
		<?php echo $form->textField($model,'DescripcionError',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'DescripcionError'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CodigoError'); ?>
		<?php echo $form->textField($model,'CodigoError',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'CodigoError'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DirectorioDocumento'); ?>
		<?php echo $form->textField($model,'DirectorioDocumento',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DirectorioDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NombreDocumento'); ?>
		<?php echo $form->textField($model,'NombreDocumento',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'NombreDocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'GeneradoXls'); ?>
		<?php echo $form->textField($model,'GeneradoXls'); ?>
		<?php echo $form->error($model,'GeneradoXls'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SecuencialERP'); ?>
		<?php echo $form->textField($model,'SecuencialERP',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'SecuencialERP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Estado'); ?>
		<?php echo $form->textField($model,'Estado'); ?>
		<?php echo $form->error($model,'Estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IdLote'); ?>
		<?php echo $form->textField($model,'IdLote',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'IdLote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CodigoTransaccionERP'); ?>
		<?php echo $form->textField($model,'CodigoTransaccionERP',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'CodigoTransaccionERP'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->