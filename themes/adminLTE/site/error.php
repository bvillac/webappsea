<?php

use Yii;
use yii\helpers\Html;

$this->title = $name;
?>
<!-- Main content -->
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $name ?></h3>
            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>
            <p>
                <?= Html::encode(Yii::t("exception", "The above error occurred while the Web server was processing your request.")) ?><br />
                <?= Html::encode(Yii::t("exception", "Please contact us if you think this is a server error. Thank you.")) ?>
            </p>
            <p><a href='<?= Yii::$app->homeUrl ?>'><?= Html::encode(Yii::t("exception", "Return to last page")) ?></a></p>
        </div>
    </div>

</section>
