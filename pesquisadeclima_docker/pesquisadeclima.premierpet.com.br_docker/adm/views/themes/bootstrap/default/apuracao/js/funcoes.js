window.url_sistema = $("base").attr("href");

$(function() {
	obterParciais();
});

function obterParciais(){
	var ajaxRequest;
	$("#list").html("<div class='loader'></div>");

	var values = $("#listagem").serialize();
	ajaxRequest= $.ajax({
					url: url_sistema + "apuracao/xhrGetListings",
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