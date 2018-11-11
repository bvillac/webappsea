<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use app\models\Menu;
use yii\helpers\Url;
use app\models\ObjetoModulo;
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <?php
            //MENU LATERAL IZQ
            $modules = Menu::getMenuModulos();
            //\app\models\Utilities::putMessageLogFile($modules);
            $rutaControl = Yii::$app->controller->route;
            $mod = new ObjetoModulo();
            $arr_mod = $mod->getModuleByObjModule($this->params["omod_id"]);            
            foreach ($modules as $row) {
                $objMod = Menu::getObjetoModulo($row['mod_id']);
                //\app\models\Utilities::putMessageLogFile($objMod);
                $mod_lang_file = isset($row['mod_lang_file']) ? $row['mod_lang_file'] : "menu";
                $mod_nombre = Yii::t($mod_lang_file, $row['mod_nombre']);
                $mod_imagen = $row['mod_dir_imagen'];
                $isImg = false;
                if (preg_match("/(\.png|\.jpeg|\.jpg)/i", $mod_imagen)) {
                    $isImg = true;
                }
                
                if ($row['mod_id'] == $id_modulo || $row['mod_url'] == $rutaControl || $row['mod_url'] == $arr_mod['mod_url']) {
                    $classMod = "active";
                } else {
                    $classMod = "";
                }
                //$img_file = Yii::$app->view->theme->baseUrl . '/images/modulos/default.png';
                //if(file_exists(Yii::$app->view->theme->basePath.'/images/modulos/'.$row['mod_dir_imagen']) && $row['mod_dir_imagen'] != ""){
                //    $img_file = Yii::$app->view->theme->baseUrl.'/images/modulos/'.$row['mod_dir_imagen'];
                //}
                if (count($objMod) > 0) {
                    $menu.='<li class="treeview ' . $classMod . '">';
                    $btn_arrow = ($classMod == "active") ? 'menu-open' : '';
                    if (isset($row['mod_url']) && $row['mod_url'] != "") {
                        if (!$isImg)
                            $menu.= "<a href='" . Url::home() . $row['mod_url'] . "'><i class='" . $mod_imagen . "'></i><span>" . $mod_nombre . "</span> <i class='fa fa-angle-left pull-right'></i></a>";
                        //$menu .= Html::a($mod_nombre, Url::home() . $row['mod_url']);
                    } else {
                        if (!$isImg)
                            $menu.= "<a href='javascript:'><i class='" . $mod_imagen . "'></i><span>" . $mod_nombre . "</span> <i class='fa fa-angle-left pull-right'></i></a>";
                    }
                    $menu.= '<ul class="treeview-menu ' . $btn_arrow . '">';
                    foreach ($objMod as $row1) {
                        $omod_lang_file = isset($row1['omod_lang_file']) ? $row1['omod_lang_file'] : "menu";
                        $omod_nombre = Yii::t($omod_lang_file, $row1['omod_nombre']);
                        $icon = "fa fa-circle-o";
                        $classObj = "";
                        if ($row1['omod_entidad'] == $rutaControl) {
                            $classObj = 'class="active"';
                            $icon = "fa fa-circle";
                        }
                        $menu.="<li $classObj>";
                        //$menu.=Html::a($omod_nombre, Url::home() . $row1['omod_entidad']);
                        $menu.= "<a href='" . Url::home() . $row1['omod_entidad'] . "'><i class='" . $icon . "'></i>" . $omod_nombre . "</a>";
                        $menu.='</li>';
                    }
                    $menu.='</ul>';
                    $menu.='</li>';
                } else { // si no tiene hijos u objetos Modulos
                    $menu .= '<li class="' . $classMod . '">';
                    if (isset($row['mod_url']) && $row['mod_url'] != "") {
                        //$menu .= Html::a($mod_nombre, Url::home() . $row['mod_url']);
                        if (!$isImg)
                            $menu.= "<a href='" . Url::home() . $row['mod_url'] . "'><i class='" . $mod_imagen . "'></i><span>" . $mod_nombre . "</span></a>";
                    } else {
                        if (!$isImg)
                            $menu.= "<a href='javascript:'><i class='" . $mod_imagen . "'></i><span>" . $mod_nombre . "</span></a>";
                    }
                    $menu .= '</li>';
                }
                $cont++;
            }
            echo $menu;
            ?>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>