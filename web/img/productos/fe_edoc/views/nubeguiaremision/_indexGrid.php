<?php
/**
 * Este Archivo contiene las vista de Compañias
 * @author Ing. Byron Villacreses <byronvillacreses@gmail.com>
 * @copyright Copyright &copy; SolucionesVillacreses 2014-09-24
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\fe_edoc\models\VSacceso;
?>
<?=

PbGridView::widget([
    //'dataProvider' => new yii\data\ArrayDataProvider(array()),
    'id' => 'TbG_DOCUMENTO',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' =>
        [
        [
            //'id' => 'chkId',
            'class' => 'app\widgets\PbGridView\PbCheckboxColumn',
            //'cssClassExpression' => '($data["Estado"]=="2")?"disabled":""',
            //'disabled' => '($data["Estado"]=="2")?true:false',
        ],
        [
            'attribute' => 'IdDoc',
            'header' => Yii::t('COMPANIA', 'IdDoc'),
            'value' => 'IdDoc',
            'visible' => '0',
            
        ],
        [
            'header' => Yii::t('COMPANIA', 'Download'),
            'class' => 'yii\grid\ActionColumn',
            'options' => array('style' => 'text-align:center', 'width' => '85px'),
            'template' => '{pdf} {xml}',
            'buttons' => array(
                'pdf' => function ($url, $model) {
                    return Html::a('<span class="text-danger fa fa-file-pdf-o"></span>', Url::to(['nubeguiaremision/generarddf', 'ids' => base64_encode($model['IdDoc'])]), ["data-toggle" => "tooltip", "title" => Yii::t('fe_edoc', 'Download PDF document'), "data-pjax" => 0]);
                },
                'xml' => function ($url, $model) {
                    return Html::a('<span class="text-success fa fa-file-code-o"></span>', Url::to(['nubeguiaremision/xmlautorizado', 'ids' => base64_encode($model['IdDoc'])]), ["data-toggle" => "tooltip", "title" => Yii::t('fe_edoc', 'Download XML document'), "data-pjax" => 0]);
                },
            ),
        ],
        [
            'attribute' => 'Estado',
            'header' => Yii::t('fe_edoc', 'Status'),
            'value' => function ($data) {
                return VSacceso::estadoAprobacion($data["Estado"]);
            },
        ],
        [
            'attribute' => 'NombreDocumento',
            'header' => Yii::t('fe_edoc', 'Document type'),
            'value' => 'NombreDocumento',
        ],
        [
            'attribute' => 'NumDocumento',
            'header' => Yii::t('fe_edoc', 'Document Number'),
            'options' => array('style' => 'text-align:center'),
            'value' => 'NumDocumento',
        ],
        [
            'attribute' => 'FechaEmisionErp',
            'header' => Yii::t('fe_edoc', 'Issuance date'),
            'value' => function ($data) {
                return date(Yii::$app->params["dateByDefault"], strtotime($data["FechaEmisionErp"]));
            },
        ],
        [
            'attribute' => 'UsuarioCreador',
            'header' => Yii::t('fe_edoc', 'Serving'),
            'value' => 'UsuarioCreador',
            'options' => array('style' => 'text-align:center'),
            'visible' => '0',
        ],
        [
            'attribute' => 'FechaAutorizacion',
            'header' => Yii::t('fe_edoc', 'Authorization date'),
            'value' => function ($data) {
                return ($data["FechaAutorizacion"] <> "") ? date(Yii::$app->params["dateByDefault"], strtotime($data["FechaAutorizacion"])) : "";
            },
        ],
        [
            'attribute' => 'IdentificacionComprador',
            'header' => Yii::t('fe_edoc', 'Dni/Ruc'),
            'value' => 'IdentificacionDestinatario',
        ],
        [
            'attribute' => 'RazonSocialComprador',
            'header' => Yii::t('fe_edoc', 'Company name'),
            //'htmlOptions' => array('style' => 'text-align:left', 'width' => '300px'),
            'value' => 'RazonSocialDestinatario',
        ],
    ],
]);
?>
