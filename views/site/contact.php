<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/*Mapa de Google*/
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;


$this->title = 'Contacto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            <!--Thank you for contacting us. We will respond to you as soon as possible.-->
            Gracias por contactarnos. Nosotros responderemos a la mayor brevedad posible.
        </div>

        <p>
            <!--Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.-->
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            <!--If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.-->
            Si tiene consultas comerciales u otras preguntas, por favor, rellene el siguiente formulario para contactar con nosotros.
            Gracias.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
            
            <div class="col-lg-7">
                
                    <p>
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"> Ventas:</span> <a href="mailto:<?= Yii::$app->params['ventasEmail']; ?>"><?= Yii::$app->params['ventasEmail']; ?></a><br>
                        <span class="glyphicon glyphicon-wrench" aria-hidden="true"> Soporte:</span> <?= Yii::$app->params['soporte']; ?><br>
                        <span class="glyphicon glyphicon-home" aria-hidden="true"> Dirección:</span> <?= Yii::$app->params['direccion']; ?><br>
                        <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"> PBX:</span><?= Yii::$app->params['telefonos']; ?><br>
                    </p>
               
                    <?php
                    $coordEmpresa = new LatLng(['lat' => -2.146441, 'lng' => -79.898044]);
                    $map = new Map([
                        'center' => $coordEmpresa,
                        'zoom' => 14,
                    ]);
                    
                    // setup just one waypoint (Google allows a max of 8)
                    $waypoints = [
                        new DirectionsWayPoint(['location' => $coordEmpresa])
                    ];
                    // Lets configure the polyline that renders the direction
                    $polylineOptions = new PolylineOptions([
                        'strokeColor' => '#FFAA00',
                        'draggable' => true
                    ]);
                    

                    // Lets add a marker now
                    $marker = new Marker([
                        'position' => $coordEmpresa,
                        'title' => Yii::$app->params['title'],
                    ]);
                    
                    // Provide a shared InfoWindow to the marker
                    $marker->attachInfoWindow(
                            new InfoWindow([
                                'content' => '<p>UTIMPOR ofrece suministros de oficina<br> </p>'
                            ])
                    );

                    // Add marker to the map
                    $map->addOverlay($marker);
                    //$map->width="100";
                    //$map->height="100";


                    // Display the map -finally :)
                    echo $map->display();
                    ?>
                
            </div>
            
            
            
        </div>

    <?php endif; ?>
</div>
