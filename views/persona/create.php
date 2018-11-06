<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = Yii::t('app', 'Create Persona');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
