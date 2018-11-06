<?php

namespace app\components;

use Yii;
use yii\base\InlineAction;
use yii\helpers\Url;
use app\models\Error;

class CController extends \yii\web\Controller
{
    public $freportini = "";
    public $freportend = "";
    public $modulo = array();
    public $botones = array();
    public $id_modulo = 0;
    public $id_objeto_modulo = 0;
    public $id_moduloPadre = 0;
    
    public function init() {
        return parent::init();
    }
    
//    public function behaviors()
//    {
//        $behaviors = \app\models\Accion::generateActions();
//        return $behaviors;
//    }
    
    public function runAction($id, $params = []){
        $session = Yii::$app->session;
        $isUser = $session->get('PB_isuser', FALSE);
        $route = $this->getRoute() . "/login";
        $usu = new \app\models\Usuario;
        $usu->regenerateSession();
        if($isUser == FALSE && $route != "site/login"){
            //$usu->destroySession(); // no se puede destruir una sesion si no existe
            $this->redirect(Yii::$app->urlManager->createUrl(["site/login"]));
        }
        return parent::runAction($id, $params);
    }

    public function beforeAction($action)
    {
        $this->createMenuModule();
        
        if (parent::beforeAction($action)) {
            $request = array_merge($_GET, $_POST);
            if(isset($request['pdf']) && $request['pdf'] == true){
                $this->layout = '@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/pdf';
            }
            $error = Yii::$app->getErrorHandler()->exception;
            if ($error !== null) {
                $this->layout = '@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/error';
                if (Yii::$app->request->isAjax) {
                    return $error['statusCode'];//$error['message'];
                } else {
                    $error = new Error(404, "", "");
                    //return $this->render('@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/error.php',["mensaje" => $error->getMessageByError()]);
                }
            }
            return true;  // or false if needed
        } else {
            return false;
        }
        
        //
        // Esto es para cambiar el tema antes de devolver el render
        // $this->getView()->theme = Yii::createObject([
        //      'class' => '\yii\base\Theme',
        //      'pathMap' => ['@app/views' => '@app/themes/basic'],
        //      'baseUrl' => '@web/themes/basic',
        //  ]);
        // 
        
    }
    
    public function createMenuModule(){
        $ctr = Yii::$app->controller->id;
        $acc = Yii::$app->controller->action->id;
        $mod = Yii::$app->controller->module->id;
        $route = $this->route;
        $session = Yii::$app->session;
        $objModule = \app\models\ObjetoModulo::findIdentityByEntity($route);
        $objModPadre = \app\models\ObjetoModulo::findIdentity($objModule->omod_padre_id);
        $module = \app\models\Modulo::findIdentity($objModule->mod_id);
        $session->set('PB_module_id', $objModule->mod_id);
        $session->set('PB_objmodule_id', $objModule->omod_id);
        
        $omod_lang_file=($objModule->omod_lang_file !='')? $objModule->omod_lang_file :'application';//File Idioma por Default
        $mod_lang_file=($module->mod_lang_file !='')? $module->mod_lang_file :'application';//File Idioma por Default
        
        $this->getView()->title = Yii::t($omod_lang_file,$objModule->omod_nombre);//Titulo Formulario
        $this->getView()->params["Module_name"]    = Yii::t($mod_lang_file,$module->mod_nombre);
        $this->getView()->params["ObjModPadre_name"] = Yii::t($omod_lang_file,$objModPadre->omod_nombre);
        $this->getView()->params["ObjModule_name"] = Yii::t($omod_lang_file,$objModule->omod_nombre);
        $this->getView()->params["mod_id"] = $module->mod_id;
        $this->getView()->params["omod_id"] = $objModule->omod_id;
        $this->getView()->params["omod_padre_id"] = $objModule->omod_padre_id;

    }
}