<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<section id="do_action">
		<div class="container">
<!--			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>-->
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Usar Cupón</label>
							</li>
<!--							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>-->
							<li>
								<input type="checkbox">
								<label>Valor Estimado Envio</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Provincía:</label>
								<select>
									<option>Guayas</option>
									<option>Manabi</option>
									<option>Pichincha</option>
									
								</select>
								
							</li>
							<li class="single_field">
								<label>País:</label>
								<select>
									<option>Select</option>
									<option>Ecuador</option>
									<option>Perú</option>
									
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
                                                    <li>Sub Total <span id="lbl_subtotal">$0.00</span></li>
<!--							<li>Eco Tax <span>$2</span></li>-->
							<li>Costo Envío<span>Gratis</span></li>
							<li>Total <span id="lbl_total">$0.00</span></li>
						</ul>
<!--							<a class="btn btn-default update" href="">Update</a>-->
							<a class="btn btn-default check_out" href="">Guardar</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->