<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use yii\helpers\Html;


$SeccPro=app\models\Tienda::getSeccionTienda();
$menu=app\models\Tienda::getMenuData();      

//print_r($menu);

//app\models\Utilities::putMessageLogFile($menu);
/*for ($n0 = 0; $n0 < sizeof($menu); $n0++){ 
    app\models\Utilities::putMessageLogFile($menu[$n0]['nom_cat']);
    $nivel=$menu[$n0]['nivel'];
    //app\models\Utilities::putMessageLogFile(sizeof($nivel));
    if(sizeof($nivel)>0){
        for ($n1 = 0; $n1 < sizeof($nivel); $n1++){//
            app\models\Utilities::putMessageLogFile($menu[$n0]['nom_cat'].'->'.$nivel[$n1]['nom_cat']);
            $subnivel=$nivel[$n1]['subnivel'];
            //app\models\Utilities::putMessageLogFile(sizeof($subnivel));
            if(sizeof($subnivel)>0){
                for ($n2 = 0; $n2 < sizeof($subnivel); $n2++){//
                    app\models\Utilities::putMessageLogFile($menu[$n0]['nom_cat'].'->'.$nivel[$n1]['nom_cat'].'->'.$subnivel[$n2]['nom_cat']);
                }
                
            }
        }
    }
    
}*/



?>

<nav class="navbar navbar-inverse colorMenu">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Inicio</a>
    </div>

    <div class="collapse navbar-collapse js-navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown mega-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tienda <span class="caret"></span></a>				
                <ul class="dropdown-menu mega-dropdown-menu">
<!--                    <li class="col-sm-3">
                        <ul>
                            <li class="dropdown-header">Men Collection</li>                            
                            <div id="menCollection" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <a href="#"><img src="http://placehold.it/254x150/ff3546/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 1"></a>
                                        <h4><small>Summer dress floral prints</small></h4>                                        
                                        <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>       
                                    </div> End Item 
                                    <div class="item">
                                        <a href="#"><img src="http://placehold.it/254x150/3498db/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 2"></a>
                                        <h4><small>Gold sandals with shiny touch</small></h4>                                        
                                        <button class="btn btn-primary" type="button">9,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>        
                                    </div> End Item 
                                    <div class="item">
                                        <a href="#"><img src="http://placehold.it/254x150/2ecc71/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 3"></a>
                                        <h4><small>Denin jacket stamped</small></h4>                                        
                                        <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>      
                                    </div> End Item                                 
                                </div> End Carousel Inner 
                                 Controls 
                                <a class="left carousel-control" href="#menCollection" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#menCollection" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div> /.carousel 
                            <li class="divider"></li>
                            <li><a href="#">View all Collection <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
                        </ul>
                    </li>-->
                    <?php for ($n0 = 0; $n0 < sizeof($menu); $n0++){ ?>                  
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header"><?php echo strtoupper($menu[$n0]['nom_cat']) ?></li>
                                    <?php $nivel=$menu[$n0]['nivel']; ?>
                                    <?php if(sizeof($nivel)>0){ ?>
                                        <li>                                      
                                            <?php for ($n1 = 0; $n1 < sizeof($nivel); $n1++){ ?>                                                
                                                <?php $subnivel=$nivel[$n1]['subnivel']; ?>
                                                <?php if(sizeof($subnivel)>0){ ?>
                                                    <li class="dropdown-header"><?php echo $nivel[$n1]['nom_cat'] ?></li>
                                                    <?php for ($n2 = 0; $n2 < sizeof($subnivel); $n2++){ ?>                                                    
                                                        <li><?= Html::a($subnivel[$n2]['nom_cat'], ['site/productos'],['onclick' => 'javascript:mostrarCategoria(\'' . base64_encode($subnivel[$n2]['ids_cat']) . '\');']); ?></li>
                                                    <?php } ?> 
                                                    <li class="divider"></li>
                                                <?php } else {?>
                                                    <li><?= Html::a($nivel[$n1]['nom_cat'], ['site/productos'],['onclick' => 'javascript:mostrarCategoria(\'' . base64_encode($nivel[$n1]['ids_cat']) . '\');']); ?></li>
                                                <?php } ?> 
                                            <?php } ?>                                        
                                        </li>
                                    <?php } ?>
                                    
                                </ul>     
                            </li>                        
                 
              
                        <!--app\models\Utilities::putMessageLogFile($menu[$n0]['nom_cat']);
                        $nivel=$menu[$n0]['nivel'];
                        //app\models\Utilities::putMessageLogFile(sizeof($nivel));
                        if(sizeof($nivel)>0){
                            for ($n1 = 0; $n1 < sizeof($nivel); $n1++){//
                                app\models\Utilities::putMessageLogFile($menu[$n0]['nom_cat'].'->'.$nivel[$n1]['nom_cat']);
                                $subnivel=$nivel[$n1]['subnivel'];
                                //app\models\Utilities::putMessageLogFile(sizeof($subnivel));
                                if(sizeof($subnivel)>0){
                                    for ($n2 = 0; $n2 < sizeof($subnivel); $n2++){//
                                        app\models\Utilities::putMessageLogFile($menu[$n0]['nom_cat'].'->'.$nivel[$n1]['nom_cat'].'->'.$subnivel[$n2]['nom_cat']);
                                    }

                                }
                            }
                        }-->

                    <?php } ?> 
                    
                    <!--<li class="col-sm-3">
                        <ul>
                            <li class="dropdown-header">Features</li>
                            <li><a href="#">Auto Carousel</a></li>
                            <li><a href="#">Carousel Control</a></li>
                            <li><a href="#">Left & Right Navigation</a></li>
                            <li><a href="#">Four Columns Grid</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Fonts</li>
                            <li><a href="#">Glyphicon</a></li>
                            <li><a href="#">Google Fonts</a></li>
                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li class="dropdown-header">Plus</li>
                            <li><a href="#">Navbar Inverse</a></li>
                            <li><a href="#">Pull Right Elements</a></li>
                            <li><a href="#">Coloured Headers</a></li>                            
                            <li><a href="#">Primary Buttons & Default</a></li>							
                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li class="dropdown-header">Much more</li>
                            <li><a href="#">Easy to Customize</a></li>
                            <li><a href="#">Calls to action</a></li>
                            <li><a href="#">Custom Fonts</a></li>
                            <li><a href="#">Slide down on Hover</a></li>                         
                        </ul>
                    </li>-->
                </ul>				
            </li>
            
            <li><a href="#">Contacto</a></li>
        </ul>
<!--        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My account <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
            <li><a href="#">My cart (0) items</a></li>
        </ul>-->
    </div><!-- /.nav-collapse -->
</nav>


