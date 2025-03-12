window.url_sistema = $("base").attr("href");

$(function() {	
	$(document).ready(function(e) {  
		if(("#list").length > 0) {
			listagem();		
		}
    });	
	
	$(document).on("click",".del", function() {    					
		var del = $(this); 	
		var id  = $(this).attr('rel');
				
		$.post(url_sistema + 'user/delete', {id : id}, function(o) {
			del.parent().remove();
		});
		
		return false;   
	});
	
});

function setpag(pagina){
	if(("#list").length > 0) {
		$("#pg").val(pagina);
		listagem();	
	}
}

function listagem() {
	var ajaxRequest;
	$("#list").html("<div class='loader'></div>");
	
	var values = $("#listagem").serialize();
	ajaxRequest= $.ajax({
					url: url_sistema + "turma/xhrGetListings",
					type: "post",							
					cache: false,
					processData: false,
					data: values
					});
	
	ajaxRequest.done(function (response, textStatus, jqXHR){
		$("#list").html(response);
	});
	
	ajaxRequest.fail(function (){	
		$("#list").html('Erro ao criar a listagem.\r\n Entre em contato com o suporte caso o problema persista!');
	})	
}