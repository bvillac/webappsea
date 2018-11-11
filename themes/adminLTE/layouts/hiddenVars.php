<?php

/*
 * The PenBlu framework is free software. It is released under the terms of
 * the following BSD License.
 *
 * Copyright (C) 2015 by PenBlu Software (http://www.penblu.com)
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *  - Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in
 *    the documentation and/or other materials provided with the
 *    distribution.
 *  - Neither the name of PenBlu Software nor the names of its
 *    contributors may be used to endorse or promote products derived
 *    from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * PenBlu is based on code by
 * Yii Software LLC (http://www.yiisoft.com) Copyright © 2008
 *
 */
use yii\helpers\Html;
use yii\helpers\Url;


?>
<?= Html::hiddenInput('txth_base', Url::base(), ["id"=>"txth_base"]) ?>
<?= Html::hiddenInput('txth_uploads', Url::base().Yii::$app->params["documentFolder"], ["id"=>"txth_uploads"]) ?>
<?= Html::hiddenInput('txth_imgfolder', Url::base().Yii::$app->params["imgFolder"], ["id"=>"txth_imgfolder"]) ?>
<?= Html::hiddenInput('txth_empresa', @Yii::$app->session->get("PB_idempresa"),["id"=>"txth_empresa"]) ?>
<?= Html::hiddenInput('txth_module', @Yii::$app->controller->module->id,["id"=>"txth_module"])  ?>
<?= Html::hiddenInput('txth_controller', @Yii::$app->controller->id,["id"=>"txth_obmodule"])  ?>
<?= Html::hiddenInput('txth_accion', @Yii::$app->controller->action->id,["id"=>"txth_accion"])  ?>
<?= Html::hiddenInput('txth_theme', @Yii::$app->session->get("PB_yii_theme"),["id"=>"txth_theme"])  ?>
<?= Html::hiddenInput('txth_userweb', @Yii::$app->session->get("PB_iduser"),["id"=>"txth_userweb"])  ?>
<?= Html::hiddenInput('txth_nombres', @Yii::$app->session->get("PB_nombres"),["id"=>"txth_nombres"])  ?>
<?= Html::hiddenInput('txth_room', 0,["id"=>"txth_room"])  ?>
