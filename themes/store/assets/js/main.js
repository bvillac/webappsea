/*price range*/

$('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
        

    
    $('.pagination li a').on('click', function(){
        //$('.items').html('<div class="loading"><img src="images/loading.gif" width="70px" height="70px"/><br/>Un momento por favor...</div>');
        var strData = "";
        var page = $(this).attr('data');
        var link = $('#txth_base').val() + "/site/index";
        var arrParams = new Object();
        arrParams.page = page;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                var data = response.message;
                for (var i = 0; i < data.length; i++) {
                    //option_arr += '<a onclick="deleteComentario(\'' + data[i]['Ids'] + '\')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>';
                    strData+=llenarItems(data[i]);
                }
                $("#listaPedidos").empty();
               // $("#listaPedidos").append(strData);
                $("#listaPedidos").html(strData);
                
                //console.log(data);
                //$('.items').fadeIn(2000).html(data);
                $('.pagination li').removeClass('active');
                $('.pagination li a[data="'+page+'"]').parent().addClass('active');
            }
        }, true);
        return false;
    });              
    
    
        
});

function llenarItems(data){
    var ruta=$('#txth_imgfolder').val()+'img1.jpg';
    var strData = "";//data[i]['p_venta']
    strData += '<div class="col-sm-4">';
        strData += '<div class="product-image-wrapper">';
            strData += '<div class="single-products">';
                strData += '<div class="productinfo text-center">';
                    //strData += '<img src="img/productos/img1.jpg" alt="" />';
                    strData += '<img src="'+ruta+'" alt="" />';
                    strData += '<h2>$' + data['p_venta'] + '</h2>';
                    strData += '<p>' + data['des_com'] + '</p>';
                    strData += '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar a Carrito</a>';
                strData += '</div>';
                /*strData += '<div class="product-overlay">';
                    strData += '<div class="overlay-content">';
                        strData += '<h2>$' + data['p_venta'] + '</h2>';
                        strData += '<p>' + data['des_com'] + '</p>';
                        strData += '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar a Carrito</a>';
                    strData += '</div>';
                strData += '</div>';*/
            strData += '</div>';
            strData += '<div class="choose">';
                strData += '<ul class="nav nav-pills nav-justified">';
                    strData += '<li><a href="#"><i class="fa fa-plus-square"></i>Agregar a lista de pedidos</a></li>';
                    strData += '<li><a href="#"><i class="fa fa-plus-square"></i>Comparacion</a></li>';
                strData += '</ul>';
            strData += '</div>';
        strData += '</div>';
    strData += '</div>';
    return strData;
}