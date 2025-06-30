window.url_sistema = $("base").attr("href");

$(function() {	
	
	
	$( ".data" ).datepicker({
		dateFormat: 'dd/mm/yy',
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		nextText: 'Próximo',
		prevText: 'Anterior'
	});
		


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
	
	$(".keyup").keyup(function(e) {
        if($(this).val().length > 1) {
			listagem();	
		}
    });
	
	$(".change, #turma, #frequencia, #tipo, #profissao, .data, #tipo_pessoa").change(function(e) {
		listagem();		
    });
	
	$("#tipo_assistencial").change(function(e) {	
				
		if( $(this).val() ) {
			$.getJSON(url_sistema + "turma/xhrGetList",{tipo_assistencial: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				$("#descricao").val(j[0].descricao);
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
				}	
				$('#turma').html(options);
			});
		} else {
			$('#turma').html('<option value=""></option>');
		}
		
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
					url: url_sistema + "falta/xhrGetListings",
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