<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= Html::encode($this->title) ?></title>
    <style type="text/css">
        .ReadMsgBody { width: 100%; }
        .ExternalClass { width: 100%; }
        div, p, a, li, td { -webkit-text-size-adjust:none; }
        h1 { color:#000033 ;font-size:26px;margin: 10px 0px; }
        h2 { color:#000033 ;font-size:14px; }
    </style>
    <?php $this->head() ?>
</head>
<body bgcolor="#FFFFFF" style="background-color:#FFFFFF">
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
