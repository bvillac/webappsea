<?php
namespace app\modules\fe_edoc;

use Yii;

class Module extends \yii\base\Module
{
    public $db_edoc;    // se debe colocar el identificador de la base que se define en el archivo de modulos: mod.php
    public $class;  // se debe colocar el la clase de la conexion de la base que se define en el archivo de modulos: mod.php
    public $controllerNamespace = 'app\modules\fe_edoc\controllers';
    private static $module_name = 'fe_edoc';
    
    public function init()
    {
        parent::init();
        //\Yii::$app->urlManager->addRules(['<module:app>/<controller:\w+>/<action:\w+>/<id:\w+>' => '<module>/<controller>/<action>']);
        Yii::configure($this, require(__DIR__ . '/config/config.php'));
        self::registerTranslations();
        //\Yii::$app->view->theme->pathMap[your_module_name.'/views'] = [your_module_name.'/themes/'.\Yii::$app->view->theme->active.'/views']; // para usar temas
    }

    public static function registerTranslations()
    {
        $fileMap = self::getMessageFileMap();
        Yii::$app->i18n->translations['modules/'. self::$module_name .'/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            //'sourceLanguage' => 'es',
            'basePath' => '@app/modules/'. self::$module_name .'/messages',
            'fileMap' => $fileMap,
            //'on missingTranslation' => ['app\components\TranslationEventHandler', 'handleMissingTranslation'],
        ];
    }
    
    private static function getMessageFileMap(){
        // read directory message
        $arrLangFiles = array();
        $dir_messages = __DIR__ . DIRECTORY_SEPARATOR . "messages";
        $fileMap = array();
        $listDirs = scandir($dir_messages);
        foreach($listDirs as $dir){
            if($dir != "." && $dir != ".."){
                $langDir = scandir($dir_messages . DIRECTORY_SEPARATOR . $dir);
                foreach ($langDir as $langFile){
                    if(preg_match("/\.php$/", trim($langFile))){
                        if(!in_array($langFile, $arrLangFiles)){
                            $arrLangFiles[] = $langFile;
                            $file = str_replace(".php", "", $langFile);
                            $key = "modules/" . self::$module_name . "/" . $file;
                            $fileMap[$key] = $langFile;
                        }
                    }
                }
            }
        }
        return $fileMap;
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/'. self::$module_name .'/' . $category, $message, $params, $language);
    }

    public static function params($alias){
        //return Yii::$app->controller->module->params[$alias];
        $module = \Yii::$app->getModule(self::$module_name);
        return $module->params[$alias];
    }
}
