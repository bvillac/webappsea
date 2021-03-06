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
?>
<div class="modal fade" id="myModalPB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span id="img-modal" class="success-modalPB"></span>
                <h4 class="modal-title" id="ModalLabelPB">Modal title</h4>
            </div>
            <div class="modal-body">Content</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>-->

<div class="modal fade" id="registroModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Crear una Cuenta Utimpor S.A.</h4>
            </div>
            <div class="modal-body">
               <form>
                   <div class="form-group">
                       <p>
                           Favor ingresar datos validos para poder registrar su cuenta. 
                       </p>                       
                   </div>
                   <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="rbt_tipo_per1" value="N" checked>
                      <label class="form-check-label" for="inlineRadio1">Persona Natural</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="rbt_tipo_per2" value="J">
                      <label class="form-check-label" for="inlineRadio2">Persona Jurídica</label>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="txt_per_empresa" placeholder="Nombre de Empresa" style="display: none">
                    </div>
                    <div class="form-group">
<!--                        <label for="recipient-name" class="col-form-label">Recipient:</label>-->
                        <input type="text" class="form-control" id="txt_per_nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="txt_per_apellido" placeholder="Apellido">
                    </div>
                   <div class="form-group">                       
                        <input type="text" class="form-control" id="txt_per_nombre_j" placeholder="Nombre de Contacto" style="display: none">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="txt_per_apellido_j" placeholder="Apellido de Contacto" style="display: none">
                    </div>
                   
                   <div class="form-group">
                        <input type="text" class="form-control" id="txt_per_ced_ruc_n" placeholder="Cédula">
                   </div>
                   <div class="form-group">
                        <input type="text" class="form-control" id="txt_per_ced_ruc_j" placeholder="Ruc" style="display: none">
                   </div>
                   <div class="form-group">
                        <input type="text" class="form-control" id="txt_dper_telefono" placeholder="Teléfono de Contacto">
                   </div>
                   <div class="form-group">
                        <input type="text" class="form-control" id="txt_per_correo" placeholder="Email (Será su nomobre de usuario)">
                   </div>
                   
                   <div class="form-group">
                       <input type="password" class="form-control" id="txt_usu_password" placeholder="Escoge una clave">
                   </div>
                   <div class="form-group">
                       <input type="password" class="form-control" id="txt_usu_password2" placeholder="Vuelve a escribir la clave">
                   </div>
                   <div class="form-group">
                       <label for="conditions_cii29" id="label_conditions_cii29">
		       <input name="txt_conditions" id="txt_conditions" value="1" type="checkbox">
                            He leído y acepto las <a href="https://www.utimpor.com/condiciones-de-uso.php" title="Leer condiciones" target="_blank">condiciones de uso</a> y la <a href="https://www.utimpor.com/condiciones-de-uso.php" title="Leer política de privacidad" target="_blank">política de privacidad</a>							</label>
                   </div>
                   <div class="form-group">
                       <button type="button" id="btn_saveCuenta" class="btn btn-primary">Nueva Cuenta</button>
                   </div>
                   <div class="form-group">
                       <p>
                           Rellena el formulario y te enviaremos un correo electrónico de confirmación para que finalices el proceso de creación de la cuenta. 
                       </p>
                       
                   </div>
                       
                       
                </form>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
<!--           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Acceder a mi cuenta de usuario</h4>
            </div>
            <div class="modal-body">
               <form>                    
                    <div class="form-group">
                       <?php if (Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert alert-danger">
                            <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success">
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                    <?php endif; ?>
                    </div>
                   <div class="form-group">
                        <input type="email" id="txt_email" class="form-control" placeholder="<?= Yii::t("app", "Email Address") ?>" />
                   </div>
                   <div class="form-group">
                        <input type="password" id="txt_password" class="form-control" placeholder="<?= Yii::t("login", "Password") ?>"/>
                   </div>
                  
                   <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="id_check">
                        <label class="form-check-label" ><?= Yii::t("login", "Remember Me") ?></label>
                   </div>
                   <div class="form-group">
                        <button id="cmd_login" type="submit" class="btn btn-primary"><?= Yii::t("login", "Login") ?></button>
                   </div>
                   <div class="form-group">
                       <a href="javascript: void(0);" title="Recordar contraseña" rel="nofollow" onclick="javascript: _cii29showRemember();">Recuperar contraseña</a>
                   </div>
                   <div class="form-group">
                       <a href="javascript: void(0);" title="Crear cuenta" onclick="javascript:nuevaCuentaModal();">Crear una cuenta en Utimpor S.A.</a>                       
                   </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>