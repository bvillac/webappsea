<?php
use yii\helpers\Html;

?>
<div style="width: 600px; margin-left: auto; margin-right: auto;">
<!--    <div style="background-color: #222d32;">
        <table border="0" cellpadding="10" cellspacing="0" width="100%">
            <tr>
                <td valign="top">
                    <div>
                        <strong>
                            <span style="color: #ffffff; font-family: Helvetica,sans-serif; font-size: 11px; line-height: 13px;">&nbsp;</span>
                        </strong>
                    </div>
                </td>
                <td valign="top" width="180">
                    <div style="text-align: right;">
                        <strong>
                            <a href="#" style="color: #ffffff; text-align: right; font-family: Helvetica,sans-serif; font-size: 11px; line-height: 13px; text-decoration: none;" target="_blank">&nbsp;</a>
                        </strong>
                    </div>
                </td>
            </tr>
        </table>
    </div>-->
    <!--<div style="text-align: center;"><img alt="banner" src="<?php //$message->embed($pathImg."/".$bannerImg); ?>" width="600" height="400"></div>-->
    <br />
    <div style="text-align: center; font-family: Arial; padding: 10px 50px 0px;">
        <span style="color:#9a4d9d; font-size:35px;">
            <?= $titleMessage ?>
        </span>
    </div>
    <!-- body message begin -->
    <div style="margin: 30px;">
        <div style="font-family: helvetica, sans-serif; color: #282828; font-size: 12px; text-align: justify;">
            <?= $body ?>
        </div>
    </div>
    <!-- body message end -->
    <div style="line-height: 23px; text-align: center; height: 10px; border-bottom: 2px solid #D3D3D3; margin: 15px 30px 30px;">&nbsp;</div>
    <br />
    <div style="background-color: #222d32;">
        <table border="0" cellpadding="10" cellspacing="0" width="100%">
            <tr>
                <td valign="middle" width="370">
                    <div>
                        <span style="color: #ffffff; font-family: Helvetica; font-size: 11px; line-height: 16px;"><?= Html::encode(Yii::$app->params["copyright"])?></span>
                    </div>
                </td>
                <td valign="middle" width="170">
                    <div>
                        <div style="text-align: right;">
                            <?php 
                            if(is_array($socialNetwork)){
                                $i=0;
                                foreach($socialNetwork as $key => $value){
                                    echo "<a href='".Html::encode($value)."' style='text-decoration: none;' target='_blank'>
                                          <img alt='".Html::encode($key)."' src='".$message->embed($pathImg.$key.".png")."' style='border:0px; text-decoration:none;' />
                                          </a>";
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>