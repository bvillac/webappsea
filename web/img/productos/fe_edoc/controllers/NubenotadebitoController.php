<?php
namespace app\modules\fe_edoc\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\modules\fe_edoc\models\NubeNotaDebito;

class NubenotadebitoController extends \app\components\CController 
{
	public $pdf_numeroaut = "";
	public $pdf_numero = "";
	public $pdf_nom_empresa = "";
	public $pdf_ruc = "";
	public $pdf_num_contribuyente = "";
	public $pdf_contabilidad = "";
	public $pdf_dir_matriz = "";
	public $pdf_dir_sucursal = "";
	public $pdf_fec_autorizacion = "";
	public $pdf_emision = "";
	public $pdf_ambiente = "";
	public $pdf_cla_acceso = "";
	public $pdf_tipo_documento = "";
	public $pdf_cod_barra = "";

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		return $this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new NubeNotaDebito;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NubeNotaDebito']))
		{
			$model->attributes=$_POST['NubeNotaDebito'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->IdNotaDebito));
		}

		return $this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NubeNotaDebito']))
		{
			$model->attributes=$_POST['NubeNotaDebito'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->IdNotaDebito));
		}

		return $this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		return $this->render('index',array(
			
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NubeNotaDebito('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NubeNotaDebito']))
			$model->attributes=$_GET['NubeNotaDebito'];

		return $this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return NubeNotaDebito the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=NubeNotaDebito::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param NubeNotaDebito $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='nube-nota-debito-form')
		{
			echo CActiveForm::validate($model);
			Yii::$app->end();
		}
	}

	public function actionGenerarpdf($ids)
	{
		try {
			$ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : null;
			$rep = new ExportFile();
			$this->layout = '@modules/fe_edoc/views/tpl_fe/main';
			$modelo = new NubeNotaDebito(); //Ejmpleo code 3
			$cabFact = $modelo->mostrarCabNc($ids);
			$detFact = $modelo->mostrarDetNc($ids);
			$impFact = $modelo->mostrarNcImp($ids);
			$adiFact = $modelo->mostrarNcDataAdicional($ids);
            
            //$Titulo=Yii::$app->getSession()->get('RazonSocial', FALSE) . " - " . $cabFact['NombreDocumento'];
            //$nameFile=$cabFact['NombreDocumento'] . '-' . $cabFact['NumDocumento'];

			$this->pdf_numeroaut = $cabFact['AutorizacionSRI'];
			$this->pdf_numero = $cabFact['NumDocumento'];
			$this->pdf_nom_empresa = $cabFact['RazonSocial'];
			$this->pdf_ruc = $cabFact['Ruc'];
			$this->pdf_num_contribuyente = $cabFact['ContribuyenteEspecial'];
			$this->pdf_contabilidad = $cabFact['ObligadoContabilidad'];
			$this->pdf_dir_matriz = $cabFact['DireccionMatriz'];
			$this->pdf_dir_sucursal = $cabFact['DireccionEstablecimiento'];
			$this->pdf_fec_autorizacion = $cabFact['FechaAutorizacion'];
			$this->pdf_emision = \app\modules\fe_edoc\Module::t("fe", 'NORMAL');//$cabFact['TipoEmision'];
			$this->pdf_ambiente = ($cabFact['Ambiente'] == 1) ? \app\modules\fe_edoc\Module::t("fe", 'PRODUCTION') : \app\modules\fe_edoc\Module::t("fe", 'TEST');
			$this->pdf_cla_acceso = $cabFact['ClaveAcceso'];
			$this->pdf_tipo_documento = \app\modules\fe_edoc\Module::t("fe", 'CREDIT NOTE');
			$this->pdf_cod_barra = "";

			$rep->createReportPdf(
				$this->render('@modules/fe_edoc/views/tpl_fe/ndebito', array(
					'cabFact' => $cabFact,
					'detFact' => $detFact,
					'impFact' => $impFact,
					'adiFact' => $adiFact,
				))
			);
			$rep->mpdf->Output('NOTA DE CREDITO_' . $cabFact['NumDocumento'] . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
            //exit;
		} catch (Exception $e) {
			$this->errorControl($e);
		}
	}

	public function actionXmlAutorizado($ids)
	{
		$ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : null;
		$modelo = new NubeNotaDebito();
		$nomDocfile = array();
		$nomDocfile = $modelo->mostrarRutaXMLAutorizado($ids);
		if ($nomDocfile["EstadoDocumento"] == "AUTORIZADO") { // Si retorna un Valor en el Array
			$nombreDocumento = $nomDocfile["NombreDocumento"];
            //echo "file created";exit;
			header('Content-type: text/xml');   // i am getting error on this line
            //Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\yii\framework\web\CController.php:793)
			header('Content-Disposition: Attachment; filename="' . $nombreDocumento . '"');
            // File to download
			readfile($nomDocfile["DirectorioDocumento"] . $nombreDocumento);        // i am not able to download the same file
		} else {
			echo "Documento No autorizado";
		}
	}
}
