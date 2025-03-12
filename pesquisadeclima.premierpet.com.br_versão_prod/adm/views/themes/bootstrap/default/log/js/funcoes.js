window.url_sistema = $("base").attr("href");

$(function() {	
	$(document).ready(function(e) {  
		if(("#list").length > 0) {
			listagem();
		}
    });	
	
	
	$('.some').click(function(e) {
        $(this).hide();
		$('.loader').show();
    });
	
	$("#empresa").change(function(e) {
		$("#pg").val("1");
		
		if(("#list").length > 0) {
			listagem();			
		}

    });	
});


function setpag(pagina){
	$("#pg").val(pagina);
	
	if(("#list").length > 0) {
		listagem();	
	}
}

var ajaxRequestLog;
function listagem() {

	if(ajaxRequestLog != null){
		clearTimeout(ajaxRequestLog);
	}
	
	$("#list").html("<div class='loader'></div>");
	
	var values = $("#listagem").serialize();
	ajaxRequestLog= $.ajax({
					url: url_sistema + "log/xhrGetListings",
					type: "post",							
					cache: false,
					processData: false,
					data: values
					});
	
	ajaxRequestLog.done(function (response, textStatus, jqXHR){
		$("#list").html(response);
	});
	
	ajaxRequestLog.fail(function (){	
		$("#list").html('Erro ao criar a listagem.<br />Entre em contato com o suporte caso o problema persista!');
	});
}

var timeout;
$("#descricao").keyup(function(e){
	var valor = $(this).val();

	if(timeout != null){
		clearTimeout(timeout);
	}

	timeout = setTimeout(function(){
		listagem();

	 }, 500);	

});