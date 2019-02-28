<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
?>

<div class="table-responsive cart_info">
    <table id="TbG_ProductosCar" class="table table-condensed">
        <thead>
            <tr class="cart_menu">
                <td class="image"><?=Yii::t("store", "Item")?></td>
                <td class="description"></td>
                <td class="price"><?=Yii::t("store", "Price")?></td>
                <td class="quantity"><?=Yii::t("store", "Quantity")?></td>
                <td class="total"><?=Yii::t("store", "Total")?></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="cart_product">
<!--                    <a href=""><img src="images/cart/one.png" alt=""></a>-->
                    <a href=""><img class='imgProCarrito' src="<?= Url::base().Yii::$app->params["imgFolder"] ?>imgG.jpg" alt=""></a>
                </td>
                <td class="cart_description">
                    <h4><a href="">AGENDA EJECUTIVA 2016 F/DORADOS VERDE</a></h4>
                    <p>Web ID: 1089772</p>
                </td>
                <td class="cart_price">
                    <p>$8.54</p>
                </td>
                <td class="cart_quantity">
                    <div class="cart_quantity_button">
                        <a class="cart_quantity_up" href=""> + </a>
                        <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                        <a class="cart_quantity_down" href=""> - </a>
                    </div>
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">$8.54</p>
                </td>
                <td class="cart_delete">
                    <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                </td>
            </tr>

            

        </tbody>
    </table>
</div>



