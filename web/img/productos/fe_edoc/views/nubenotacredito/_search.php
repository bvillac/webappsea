<?php
/* @var $this NubeNotaCreditoController */
/* @var $model NubeNotaCredito */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::$app->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'IdNotaCredito'); ?>
		<?php echo $form->textField($model,'IdNotaCredito',array('size'=>19,'maxlength'=>19)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AutorizacionSRI'); ?>
		<?php echo $form->textField($model,'AutorizacionSRI',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FechaAutorizacion'); ?>
		<?php echo $form->textField($model,'FechaAutorizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Ambiente'); ?>
		<?php echo $form->textField($model,'Ambiente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TipoEmision'); ?>
		<?php echo $form->textField($model,'TipoEmision'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RazonSocial'); ?>
		<?php echo $form->textField($model,'RazonSocial',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NombreComercial'); ?>
		<?php echo $form->textField($model,'NombreComercial',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Ruc'); ?>
		<?php echo $form->textField($model,'Ruc',array('size'=>13,'maxlength'=>13)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ClaveAcceso'); ?>
		<?php echo $form->textField($model,'ClaveAcceso',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CodigoDocumento'); ?>
		<?php echo $form->textField($model,'CodigoDocumento',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Establecimiento'); ?>
		<?php echo $form->textField($model,'Establecimiento',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PuntoEmision'); ?>
		<?php echo $form->textField($model,'PuntoEmision',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Secuencial'); ?>
		<?php echo $form->textField($model,'Secuencial',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DireccionMatriz'); ?>
		<?php echo $form->textField($model,'DireccionMatriz',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FechaEmision'); ?>
		<?php echo $form->textField($model,'FechaEmision'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DireccionEstablecimiento'); ?>
		<?php echo $form->textField($model,'DireccionEstablecimiento',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ContribuyenteEspecial'); ?>
		<?php echo $form->textField($model,'ContribuyenteEspecial'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ObligadoContabilidad'); ?>
		<?php echo $form->textField($model,'ObligadoContabilidad',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TipoIdentificacionComprador'); ?>
		<?php echo $form->textField($model,'TipoIdentificacionComprador',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RazonSocialComprador'); ?>
		<?php echo $form->textField($model,'RazonSocialComprador',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IdentificacionComprador'); ?>
		<?php echo $form->textField($model,'IdentificacionComprador',array('size'=>13,'maxlength'=>13)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Rise'); ?>
		<?php echo $form->textField($model,'Rise',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CodDocModificado'); ?>
		<?php echo $form->textField($model,'CodDocModificado',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NumDocModificado'); ?>
		<?php echo $form->textField($model,'NumDocModificado',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FechaEmisionDocModificado'); ?>
		<?php echo $form->textField($model,'FechaEmisionDocModificado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TotalSinImpuesto'); ?>
		<?php echo $form->textField($model,'TotalSinImpuesto',array('size'=>19,'maxlength'=>19)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ValorModificacion'); ?>
		<?php echo $form->textField($model,'ValorModificacion',array('size'=>19,'maxlength'=>19)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MotivoModificacion'); ?>
		<?php echo $form->textField($model,'MotivoModificacion',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Moneda'); ?>
		<?php echo $form->textField($model,'Moneda',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UsuarioCreador'); ?>
		<?php echo $form->textField($model,'UsuarioCreador',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmailResponsable'); ?>
		<?php echo $form->textField($model,'EmailResponsable',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EstadoDocumento'); ?>
		<?php echo $form->textField($model,'EstadoDocumento',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DescripcionError'); ?>
		<?php echo $form->textField($model,'DescripcionError',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CodigoError'); ?>
		<?php echo $form->textField($model,'CodigoError',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DirectorioDocumento'); ?>
		<?php echo $form->textField($model,'DirectorioDocumento',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NombreDocumento'); ?>
		<?php echo $form->textField($model,'NombreDocumento',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GeneradoXls'); ?>
		<?php echo $form->textField($model,'GeneradoXls'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SecuencialERP'); ?>
		<?php echo $form->textField($model,'SecuencialERP',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Estado'); ?>
		<?php echo $form->textField($model,'Estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IdLote'); ?>
		<?php echo $form->textField($model,'IdLote',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CodigoTransaccionERP'); ?>
		<?php echo $form->textField($model,'CodigoTransaccionERP',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->