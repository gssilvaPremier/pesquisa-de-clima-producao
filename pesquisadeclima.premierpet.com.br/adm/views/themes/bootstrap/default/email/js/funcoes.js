window.url_sistema = $("base").attr("href");

function reenviarEmails(){
	var ajaxRequest;
	$("#list").html("<div class='loader'></div>");

	var values = $("#envioEmail").serialize();
	ajaxRequest= $.ajax({
					url: url_sistema + "email/envia",
					type: "POST",
					cache: false,
					processData: false,
					data: values
					});

	ajaxRequest.done(function (response, textStatus, jqXHR){
		$("#list").html(response);
	});

	ajaxRequest.fail(function (){
		$("#list").html('Erro ao criar a apurações.\r\n Entre em contato com o suporte caso o problema persista!');
	})
}