<?php
namespace app\modules\fe_edoc\models;

use Yii;

class Placetoplay
{
    private $urlJS = "https://secure.placetopay.ec/redirection/lightbox.min.js";
    private $urlReturn = "";

    function __construct($arr_params = array())
    {
        foreach ($arr_params as $key => $value) {
            if ($key == "urlReturn")
                $this->urlReturn = $value;
        }
    }

    public function start($view){
        $script = <<<EOF
P.on('response', function(data) {
    $("#lightbox-response").html(JSON.stringify(data, null, 2));
});
P.init(processUrl);
EOF;
        $view->registerJsFile(
            $this->urlJS,
            ['depends' => [\yii\web\JqueryAsset::className()]],
            "url_script_place_to_play"
        );
        $view->registerJs($script, \yii\web\View::POS_END,"start_place_to_play");
    }
}