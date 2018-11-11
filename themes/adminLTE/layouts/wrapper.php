<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\models\ObjetoModulo;
use app\models\Modulo;
use app\models\Accion;
?>

<div class="content-wrapper">
    <?php 
    $breadcrumb = ObjetoModulo::getParentByObjModule($this->params["omod_id"], array());
    $mod = Modulo::findIdentity($this->params["mod_id"]);
    $sizeBc = count($breadcrumb);
    $posMod = $sizeBc - 1;
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
<!--        <h1>
            <?= $this->params["Module_name"] ?>
            <small><?= $this->params["ObjModPadre_name"] ?></small>
        </h1>-->
        
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <span class="glyphicon glyphicon-th"></span>
                <h3 class="box-title"><?= $this->title ?></h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-header with-border">
                <div class="btn-group"><!-- Carga de ObjetosModulos -->
                <?php 
                $objModule    = new ObjetoModulo();
                $id_module    = $this->params["mod_id"];
                $id_omod      = $this->params["omod_id"];
                $id_omodpadre = $this->params["omod_padre_id"];
                //RETORNA LOS FORMULARIO DE los MODULOS
                //$arrMod = $objModule->getObjModHijosXObjModPadre($id_module, $id_omod, $id_omodpadre);
                if(count($arrMod) > 0):
                ?>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?= $this->title ?><span class="fa fa-caret-down"></span></button>
                <?php if(count($arrMod) > 0):?>
                    <ul class="dropdown-menu">
                <?php 
                        $li = "";
                        foreach ($arrMod as $key => $value){
                            if($value['omod_id'] != $id_omod){
                                $li .= '<li><a href="'.Yii::$app->urlManager->createUrl($value['omod_entidad']).'">'.Yii::t($value['omod_lang_file'],$value['omod_nombre']).'</a></li>';
                            }
                        }
                        echo $li;
                    endif;
                ?>
                    </ul>
                <?php else: ?>
                <?php endif; ?> 
                </div>
                <div class="pull-right"><!-- Carga de Acciones -->
                <?php
                    //Retorna las Acciones de un Formulario
                    $acciones = new Accion();
                    $arrAcc = $acciones->getAccionesObjModulo($id_omod);
                    if(count($arrAcc) > 0):
                ?>
                    <div class="btn-group"> 
                <?php
                        $botones = "";
                        foreach($arrAcc as $key => $value){
                            $acc_imagen = $value["acc_dir_imagen"];
                            $isImg = false;
                            if(preg_match("/(\.png|\.jpeg|\.jpg)/i", $acc_imagen)){
                                $isImg = true;
                            }
                            $acc_lang_file = isset($value["acc_lang_file"])?$value["acc_lang_file"]:"menu";
                            $acc_nombre = Yii::t($acc_lang_file, $value["acc_nombre"]);
                            if(isset($value["omod_function"]) && $value["omod_tipo_boton"] == 1){
                                $function = 'onclick="'.$value["omod_function"].'()"';
                                if(!$isImg)
                                    $botones .= '<button type="button" class="btn btn-default btnAccion" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="'.$acc_nombre.'" '.$function.'><i class="'.$acc_imagen.'"></i></button>';
                            }else{
                                if(!$isImg)
                                    $botones .= '<a href="'.Yii::$app->urlManager->createUrl($value["omod_entidad"]).'" class="btn-default"><button type="button" class="btn btn-default btnAccion" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="'.$acc_nombre.'"><i class="'.$acc_imagen.'"></i></button></a>';
                            }
                        }
                        echo $botones;
                ?>
                    </div>
                <?php
                    endif;
                ?>
                </div>
            </div>
            <div class="box-body">
                <?= $content ?>
            </div><!-- /.box-body -->
            <!--<div class="box-footer">
                Footer
            </div>--><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

