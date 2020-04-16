import '../scss/consulta.scss';
import '@chenfengyuan/datepicker/dist/datepicker.min.js';
import '@chenfengyuan/datepicker/dist/datepicker.min.css';
import '@chenfengyuan/datepicker/i18n/datepicker.es-ES.js';

$('#fecha').datepicker({
	language: 'es-ES',
	format: 'yyyy-mm-dd'
});

//ruc init
$('#ruc').on('keypress',function(){
	var leng = $('#ruc').val().length;		
	if (leng > 10) {
		validRuc();
	} else {
		$('.row').addClass('disabled');
	}
	if (leng > 10) {
		return false;
	}
});
var getKeyCode = function (str) {
    return str.charCodeAt(str.length);
}
$('#ruc').on('keyup',function(){
	if (navigator.userAgent.match(/Android/i)) {
        var leng = $('#ruc').val().length;	
        //var charKeyCode = e.keyCode || e.which;
        /*if (charKeyCode == 0 || charKeyCode == 229) { 
            charKeyCode = getKeyCode(inputValue);*/
            if (leng > 9) {
				validRuc();
			} else {
				$('.row').addClass('disabled');
			}
			if (leng > 10) {
				return false;
			}
        /*}*/
    }
});
$('#ruc').on('blur',function(){
	var leng = $('#ruc').val().length;
	if (leng == 11) {
		validRuc();
	} else {
		$('.row').addClass('disabled');
	}
});
//ajax consulta ruc
function validRuc(){
	var ruc_val = $('#ruc').val();
	$.ajax({
        url: '/wp-admin/admin-ajax.php',
        method: 'POST',
        data: {
            action: 'callurlConsulta',
        	ruc: ruc_val
        },
        beforeSend: function() {
        	$('.rucPrincipalInput').addClass('loading');
	  		$('#reactCont').html('');
	  		$('#tipo_documento').val('01');
	  		$('#serie').val('');
	  		$('#numero').val('');
	  		$('#fecha').val('');
	  		$('#importe').val('');
        },
        success: function (resp) {
           //send coords map
           var respuesta = resp.split('|');
           var state = respuesta[respuesta.length-1];
           var token = respuesta[respuesta.length-3];
           var userApi = respuesta[4];
           if (state == 'no_existe') {
           		$('.errorRuc').show();
           		$('#ruc').data('token',token);
			    $('#ruc').data('userapi',userApi);
			    $('#ruc').data('state',state);
			    $('.row').removeClass('disabled');
           }
           if (state == 'existe_pdf') {
           		$('.errorRuc').hide();
           		$('#ruc').data('token',token);
           		$('#ruc').data('userapi',userApi);
			    $('#ruc').data('state',state);
           		$('.row').removeClass('disabled');
           }
           if (state == 'existe_todos') {
           		$('.errorRuc').hide();
           		$('#ruc').data('token',token);
           		$('#ruc').data('userapi',userApi);
			    $('#ruc').data('state',state);
           		$('.row').removeClass('disabled');
           }
           if (resp == false || resp.split('<html>').length > 0) {
           		$.ajax({
				  url : 'http://facturafree.com/api/client',
				  type: 'POST',
				  dataType : "json",
				  headers: {
				  	Authorization: "Bearer tpTwQkV7wRfvCfqSkiddigsP16rmPEC5oeaAH3zh1aJGsCwSvo"
				  },
				  data: {number: ruc_val},
				  success: function (resp) {
				  	   var new_state = resp.estate;
			           var new_userApi = resp.user_api;
			           var new_token = resp.token_api;
			           if (new_state == 'no_existe') {
			           		$('.errorRuc').show();
			           		$('#ruc').data('token',new_token);
			           		$('#ruc').data('userapi',new_userApi);
			           		$('#ruc').data('state',new_state);
			           		$('.row').removeClass('disabled');
			           }
			           if (new_state == 'existe_pdf') {
			           		$('.errorRuc').hide();
			           		$('#ruc').data('token',new_token);
			           		$('#ruc').data('userapi',new_userApi);
			           		$('#ruc').data('state',new_state);
			           		$('.row').removeClass('disabled');
			           }
			           if (new_state == 'existe_todos') {
			           		$('.errorRuc').hide();
			           		$('#ruc').data('token',new_token);
			           		$('#ruc').data('userapi',new_userApi);
			           		$('#ruc').data('state',new_state);
			           		$('.row').removeClass('disabled');
			           }
				  }
				});
           }
           $('.rucPrincipalInput').removeClass('loading');
        },
        error: function(e) {
        	console.log('error');
        }
    });    
}
//validfun
$('.validFun').on('keypress',function(){
	var serie_leng = $('#serie').val().length;
	var numero_leng = $('#numero').val().length;
	var fecha_leng = $('#fecha').val().length;
	var importe_leng = $('#importe').val().length;
	if (serie_leng > 0 && numero_leng > 0 && fecha_leng > 0 && importe_leng > 0) {
		$('#send').attr('disabled',false);
	} else {
		$('#send').attr('disabled',true);
	}
});

$('.validFun').on('blur',function(){
	var serie_leng = $('#serie').val().length;
	var numero_leng = $('#numero').val().length;
	var fecha_leng = $('#fecha').val().length;
	var importe_leng = $('#importe').val().length;
	if (serie_leng > 0 && numero_leng > 0 && fecha_leng > 0 && importe_leng > 0) {
		$('#send').attr('disabled',false);
	} else {
		$('#send').attr('disabled',true);
	}
});

$('#send').on('click',function(){
	var userapi = $('#ruc').data('userapi');
	var userstate = $('#ruc').data('state');
	var urlApi = 'http://'+userapi+'.facturafree.com/api/servicio/validar_cpe';
	$.ajax({
	  url : urlApi,
	  type: 'POST',
	  dataType : "json",
	  headers: {
	  	Authorization: "Bearer tpTwQkV7wRfvCfqSkiddigsP16rmPEC5oeaAH3zh1aJGsCwSvo"
	  },
	  data: {
	  	ruc_emisor: $('#ruc').val(),
	  	codigo_tipo_documento: $('#tipo_documento').val(),
	  	serie_documento: $('#serie').val(),
	  	numero_documento: $('#numero').val(),
	  	fecha_de_emision: $('#fecha').val(),
	  	total: $('#importe').val()
	  },
	  beforeSend: function() {
	  	$('.reactForm').addClass('loadingC');
	  },
	  success: function (resp) {		
		var serie_num = $('#serie').val()+'-'+$('#numero').val();
		var data = '';
		if (resp.data.comprobante_estado_codigo == '1') {
			data = 'La Factura electrónica '+serie_num+', ha sido ';
		}
		if (resp.data.comprobante_estado_codigo == '3') {
			data = 'La Boleta electrónica '+serie_num+', ha sido ';
		}
		if (resp.data.comprobante_estado_codigo == '7') {
			data = 'La Nota de crédito electrónica '+serie_num+', ha sido ';
		}
		if (resp.data.comprobante_estado_codigo == '8') {
			data = 'La Nota de debito electrónica '+serie_num+', ha sido ';
		}
	  	var estado = '<li>'+data+' '+resp.data.comprobante_estado_descripcion+'</li>';
		var condicion_description = '<li><p class="st">Condición de la empresa: </p><p>'+resp.data.empresa_condicion_descripcion+'</p></li>';
		var link_pdf = '<a href="'+resp.data.download_pdf+'" class="pdf" target="_blank">Descargar PDF</a>';	
		var link_xml = '<a href="'+resp.data.download_xml+'" class="xml" target="_blank">Descargar XML</a>';
		var link_cdr = '<a href="'+resp.data.download_cdr+'" class="cdr" target="_blank">Descargar CDR</a>';
		var links = link_pdf+link_xml+link_cdr;
		if ($('#ruc').data('state') == 'existe_pdf') {
			links = link_pdf;
		}
		if (userstate != 'no_existe') {
	  		$('.sendspecial').show();	
	  		$('#sendEmail').data('data',resp.data.external_id);		
		} else {
			$('.sendspecial').hide();	
		}
	  	var template = '<div class="contenido_list"><div class="list"><ul>'+estado+'</ul></div><div class="links_donwload">'+links+'</div></div>';
	  	$('#reactCont').html('');
	  	if (resp.data.comprobante_estado_codigo == '0' || resp.data.comprobante_estado_codigo == '-') {
	  		$('#reactCont').append('<div class="contenido_list"><div class="msj">EL COMPROBANTE NO FUE INFORMADO A SUNAT, VERIFIQUE SUS DATOS</div></div>');	
			$('.sendspecial').hide();	
	  	} else {
	  		$('#reactCont').append(template);
	  	}
	  	$('.reactForm').removeClass('loadingC');
	  }
	});
});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

$('#email').on('keypress',function(){
	var leng = $('#email').val();
	if (validateEmail(leng)) {
		$('#sendEmail').attr('disabled',false);
	} else {
		$('#sendEmail').attr('disabled',true);
	}
});

$('#ruc').on('keyup',function(){
	var leng = $('#email').val();
	if (validateEmail(leng)) {
		$('#sendEmail').attr('disabled',false);
	} else {
		$('#sendEmail').attr('disabled',true);
	}	
});

$('#email').on('blur',function(){
	var leng = $('#email').val();
	if (validateEmail(leng)) {
		$('#sendEmail').attr('disabled',false);
	} else {
		$('#sendEmail').attr('disabled',true);
	}
});

$('#sendEmail').on('click',function(){
	var userapi = $('#ruc').data('userapi');
	var email = $('#email').val();
	var external_id = $('#sendEmail').data('data');
	var token = 'Bearer '+$('#ruc').data('token');
	var urlApi = 'http://'+userapi+'.facturafree.com/api/documents/email';
	$.ajax({
	  url : urlApi,
	  type: 'POST',
	  dataType : "json",
	  headers: {
	  	Authorization: token
	  },
	  data: {
	  	external_id: external_id,
	  	correo_electronico: email
	  },
	  beforeSend: function() {
	  	$('.sendspecial').addClass('loadingC');
	  },
	  success: function (resp) {
		if (resp.success) {
			$('.mensaje_email').html(resp.message);
			$('.mensaje_email').addClass('true');
		} else {
			$('.mensaje_email').html('Error al enviar el mensaje, pruebe más tarde');
			$('.mensaje_email').addClass('error');
		}
		$('.sendspecial').removeClass('loadingC');
	  }
	});
});
