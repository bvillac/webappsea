 <?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Url;
use yii\helpers\Html;

$menu = app\models\Tienda::getMenuData();
//app\models\Utilities::putMessageLogFile($menu);

?>
<nav class="navbar navbar-default colorMenu" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
<!--            <a class="navbar-brand" href="#"></a>-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
            <ul class="nav navbar-nav">
                <li><?= Html::a(Yii::t("store", "Home"), ['site/index'],['class' => 'active']); ?></li>   
                <li class="dropdown mega-dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tienda <span class="caret"></span></a>				
                    <div class="dropdown-menu mega-dropdown-menu">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <?php for ($n0 = 0; $n0 < sizeof($menu); $n0++){ ?> 
                                <li class="<?= ($n0 == 0)? "active":"" ?>"><a href="#<?php echo str_replace(" ","_",strtoupper($menu[$n0]['nom_cat'])) ?>" role="tab" data-toggle="tab"><?php echo strtoupper($menu[$n0]['nom_cat']) ?></a></li>
                            <?php } ?> 
                        </ul> 
                        <div class="container-fluid">
                            <!-- Tab panes active-->
                            <div class="tab-content">
                                <?php for ($n0 = 0; $n0 < sizeof($menu); $n0++){ ?> 
                                    <div class="tab-pane <?= ($n0 == 0)? "active":"" ?>" id="<?php echo str_replace(" ","_",strtoupper($menu[$n0]['nom_cat'])) ?>">                                        
                                        <?php $nivel=$menu[$n0]['nivel']; ?>
                                        <?php if(sizeof($nivel)>0){ ?>                                                
                                            <?php for ($n1 = 0; $n1 < sizeof($nivel); $n1++){ ?> 
                                                <ul class="col-sm-2">                                                            
                                                    <?php $subnivel=$nivel[$n1]['subnivel']; ?>
                                                    <?php if(sizeof($subnivel)>0){ ?>
                                                        <li class="menu_header"><a href="#"><?php echo $nivel[$n1]['nom_cat'] ?></a></li>
                                                        <?php for ($n2 = 0; $n2 < sizeof($subnivel); $n2++){ ?>                                                    
                                                        <li class="itemsubmenu"><?= Html::a($subnivel[$n2]['nom_cat'], ['site/productos','codigo' => base64_encode($subnivel[$n2]['ids_cat'])]); ?></li>                                                    
                                                        <?php } ?>                                                                                                                     
                                                    <?php } else { ?>
                                                        <li class="itemsubmenu"><?= Html::a($nivel[$n1]['nom_cat'], ['site/productos','codigo' => base64_encode($nivel[$n1]['ids_cat'])]); ?></li> 
                                                    <?php } ?>
                                                </ul>        
                                            <?php } ?>                        
                                        <?php } ?>                                            
                                    </div>
                                <?php } ?> 
                            </div>
                        </div>
                                           
                    </div>				
                </li>
                <li><?= Html::a(Yii::t("store", "Contact"), ['site/contact']); ?></li>   
            </ul>
<!--            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Buscar">
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            </form>-->
            <!--        <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                          </ul>
                        </li>
                    </ul>-->
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


