window.url_sistema = $("base").attr("href");

$(function() {	
	$(document).ready(function(e) {  
		if(("#list").length > 0) {
			carregaComboLotes(4); //BRASCORP
			listagem();
		}
		if(("#listRel").length > 0) {
			listagemRelatorios();		
		}
		if(("#listExc").length > 0) {
			listagemExcel();		
		}

		if(("#listEmails").length > 0) {
			listagemEmails();		
		}
    });	
	
	
	$('.some').click(function(e) {
        $(this).hide();
		$('.loader').show();
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
	
	$("#empresa, #lote, #setor, #distribuidor_setor, #setor_premier, #progato_setor").change(function(e) {
		$("#pg").val("1");
		
		if(("#list").length > 0) {
			if($(this).attr("name") == "empresa"){
				carregaComboLotes($("#empresa").val());
			}
			listagem();			
		}
		if(("#listRel").length > 0) {
			listagemRelatorios();		
		}
		if(("#listExc").length > 0) {
			listagemExcel();		
		}
		if(("#listEmails").length > 0) {
			listagemEmails();		
		}
    });
	
	$("#local").change(function(e) {	
		
		if( $(this).val() ) {
			$.getJSON(url_sistema + "chave/xhrGetList",{local: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value></option>';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].codigo + '">' + j[i].nome + '</option>';
				}	
				$('#setor_premier').html(options);
			});
		} else {
			$('#setor_premier').html('<option value=""></option>');
		}
		
    });
	
});


// function reenviarEmail(email){

// 	if(!confirm("Deseja realmente enviar esse e-mail?")) return false;

// 	var empresa = $("#empresa").val();
// 	var reenviar = 1;
// 	var qtd_chaves = 1;
// 	var enviar_email = 1;

// 	$.post(url_sistema + "chave/create",{empresa: empresa, reenviar: reenviar, qtd_chaves : qtd_chaves, email : email, enviar_email : enviar_email}, function(r){

// 		var retorno = JSON.parse(r);

// 		alert(retorno.mensagem);
// 		if(retorno.erro != 1){
// 			listagemEmails();
// 		}

// 	});

// }


// function reenviarTodosEmails() {
//     // Seleciona todos os botões de reenviar email na tabela
//     const buttons = document.querySelectorAll('#listEmails .btn.btn-default.btn-sm');

//     // Verifica se há botões e, se não, exibe um alerta
//     if (buttons.length === 0) {
//         mostrarNotificacao("Nenhum botão de reenviar encontrado.", 'erro');
//         return;
//     }

//     // Loop através de cada botão de reenviar
//     buttons.forEach(button => {
//         // Pega o e-mail a partir do onclick do botão
//         const email = button.getAttribute('onclick').match(/'(.*?)'/)[1];

//         // Chama a função para reenviar o e-mail sem pedir confirmação
//         reenviarEmail(email);
//     });
// }



function reenviarEmail(email) {

    var empresa = $("#empresa").val();
    var reenviar = 1;
    var qtd_chaves = 1;
    var enviar_email = 1;

    // Mostra na lista que o envio começou
    adicionarStatusEnvio(email, "Enviando...");

    $.post(url_sistema + "chave/create", {
        empresa: empresa,
        reenviar: reenviar,
        qtd_chaves: qtd_chaves,
        email: email,
        enviar_email: enviar_email
    }, function (r) {

        var retorno = JSON.parse(r);

        // Atualiza a mensagem na lista com base no retorno, sem exibir alert adicional
        if (retorno.erro != 1) {
            if (retorno.mensagem.includes('CHAVE')) {
                // Primeiro envio com a chave na mensagem
                adicionarStatusEnvio(email, retorno.mensagem);
            } else {
                // Reenvio - mensagem sem a chave
                adicionarStatusEnvio(email, `Chave reenviada para ${email}`);
            }
            listagemEmails();
        } else {
            adicionarStatusEnvio(email, `Erro ao enviar: ${retorno.mensagem}`);
        }

    });
}

// Função auxiliar para adicionar status na lista de envios
function adicionarStatusEnvio(email, mensagem) {
    const listaStatus = document.getElementById('listaStatus');
    const item = document.createElement('li');
    item.innerHTML = `E-mail: ${email} - ${mensagem}`;
    listaStatus.appendChild(item);
}

function reenviarTodosEmails() {
    // Seleciona todos os botões de reenviar email na tabela
    const buttons = document.querySelectorAll('#listEmails .btn.btn-default.btn-sm');

    // Verifica se há botões e, se não, exibe um alerta
    if (buttons.length === 0) {
        mostrarNotificacao("Nenhum botão de reenviar encontrado.", 'erro');
        return;
    }

    // Solicita confirmação apenas uma vez para todos os envios
    if (!confirm("Deseja realmente reenviar todos esses e-mails?")) return;

    // Limpa a lista de status antes de reenviar todos os e-mails
    const listaStatus = document.getElementById('listaStatus');
    listaStatus.innerHTML = "";

    // Loop através de cada botão de reenviar
    buttons.forEach(button => {
        // Pega o e-mail a partir do onclick do botão
        const email = button.getAttribute('onclick').match(/'(.*?)'/)[1];

        // Chama a função para reenviar o e-mail sem pedir confirmação
        reenviarEmail(email);
    });
}





function carregaComboLotes(idempresa){

	$.getJSON(url_sistema + "chave/xhrGetLotes",{idempresa: idempresa, ajax: 'true'}, function(j){
		var options = '<option value="0"></option>';
		for (var i = 0; i < j.length; i++) {
			options += '<option value="' + j[i].codigo + '">' + j[i].nome + '</option>';
		}
		$('#lote').html(options);
	});
}

function setpag(pagina){
	$("#pg").val(pagina);
	
	if(("#list").length > 0) {
		listagem();	
	}
	if(("#listRel").length > 0) {
		listagemRelatorios();		
	}
	if(("#listExc").length > 0) {
		listagemExcel();		
	}

	if(("#listEmails").length > 0) {
		listagemEmails();		
	}
}

function listagem() {
	var ajaxRequest;
	$("#list").html("<div class='loader'></div>");
	
	var values = $("#listagem").serialize();
	ajaxRequest= $.ajax({
					url: url_sistema + "chave/xhrGetListings",
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

function listagemRelatorios() {
	var ajaxRequest;
	$("#listRel").html("<div class='loader'></div>");
	
	var values = $("#listagem").serialize();
	ajaxRequest= $.ajax({
					url: url_sistema + "chave/xhrGetListingsRelatorios",
					type: "post",							
					cache: false,
					processData: false,
					data: values
					});
	
	ajaxRequest.done(function (response, textStatus, jqXHR){
		$("#listRel").html(response);
	});
	
	ajaxRequest.fail(function (){	
		$("#listRel").html('Erro ao criar a listagem.\r\n Entre em contato com o suporte caso o problema persista!');
	})	
}


function enviaEmail(e){

	var ajaxRequest;
	var values = $("#listagem").serialize();
	ajaxRequest= $.ajax({
					url: url_sistema + "chave/gravamail",
					type: "post",							
					cache: false,
					processData: false,
					data: values
					});
	
	ajaxRequest.done(function (response, textStatus, jqXHR){

		var json = JSON.parse(response);
		if(json.erro == 0){
			cancelarEdicao();
			listagemEmails();
		}

		alert(json.mensagem);
	});
	
	ajaxRequest.fail(function (){	
		alert('Erro ao gravar e-mail.');
	});

	return false;

}

function listagemExcel() {
	var ajaxRequest;
	$("#listExc").html("<div class='loader'></div>");
	
	var values = $("#listagem").serialize();
	ajaxRequest= $.ajax({
					url: url_sistema + "chave/xhrGetListingsExcel",
					type: "post",							
					cache: false,
					processData: false,
					data: values
					});
	
	ajaxRequest.done(function (response, textStatus, jqXHR){
		$("#listExc").html(response);
	});
	
	ajaxRequest.fail(function (){	
		$("#listExc").html('Erro ao criar o excel.\r\nEntre em contato com o suporte caso o problema persista!');
	})	
}


var timeout;
$("#filtro_email").keyup(function(e){
	var valor = $(this).val();

	if(timeout != null){
		clearTimeout(timeout);
	}

	timeout = setTimeout(function(){ 
		
		$("#email_filtro").val(valor);
		$("#situacao_filtro").val($("#situacao").val());
		listagemEmails();

	 }, 500);	

});

$("#situacao").change(function(e){

	$("#email_filtro").val($("#filtro_email").val());
	$("#situacao_filtro").val($(this).val());
	listagemEmails();

});

var ajaxRequestEmails;
function listagemEmails() {

	if(ajaxRequestEmails != null){
		ajaxRequestEmails.abort();
	}
	
	$("#listEmails").html("<div class='loader'></div>");
	
	var values = $("#listagem").serialize();

	ajaxRequestEmails = $.ajax({
								url: url_sistema + "chave/xhrGetListingsEmails",
								type: "post",							
								cache: false,
								processData: false,
								data: values
							});
	
	ajaxRequestEmails.done(function (response, textStatus, jqXHR){
		$("#listEmails").html(response);
	});
	
	ajaxRequestEmails.fail(function (){	
		$("#listEmails").html('Erro ao criar a listagem.\r\n Entre em contato com o suporte caso o problema persista!');
	})	
}


function getBase64(file) {

	return new Promise(resolve => {

		var reader = new FileReader();
	   reader.readAsDataURL(file);
	   reader.onload = function () {
	     resolve(reader.result);
	   };
	   reader.onerror = function (error) {
	     resolve('Error: ', error);
	   };

	});
}

function cancelarEdicao(){
	$("#empresa").attr("disabled", false);
	$('input[name="email"]').val("");
	$('input[name="idemail"]').val("0");
	$('.btnCancelar').hide();
}

function editEmail(id, email){
	$("#empresa").attr("disabled", true);
	$('input[name="email"]').val(email);
	$('input[name="idemail"]').val(id);
	$('.btnCancelar').show();
}

function deleteEmail(email){

	if(confirm("Deseja realmente excluir o email: " + email + "?")){
		var idempresa = $("#empresa").val();
		$.post(url_sistema + "chave/excluirEmail", {email : email, idempresa : idempresa}, function(r){
			var retorno = JSON.parse(r);

			alert(retorno.mensagem);
			if(retorno.erro != 1){
				listagemEmails();
			}
	});
	}
}


$(document).ready(function () {
    var max_size_file = ((5 * 1024) * 1024); //5MB
    var extPermitidas = ['csv'];
    
    $("#arquivo_importar").change( async function(){
        var fileInput = $(this);
        fileInput.attr("disabled", true);        
        if (fileInput.get(0).files.length) {
            var fileSize = fileInput.get(0).files[0].size;

            console.log(fileSize);

            if (fileSize > max_size_file) {
                alertErrorShow('O tamanho do seu arquivo é maior que ' + ( max_size_file / 1024 / 1024) + ' MB');
                return false;
            } else if(typeof extPermitidas.find(function(ext){ return fileInput.val().split('.').pop() == ext; }) == 'undefined') {
                alertErrorShow("Extensão inválida, por favor envie arquivos com extensão .CSV");
            } else {
            	var base64 = await getBase64(fileInput.get(0).files[0]);
                enviaArquivo(base64);
                return false;
            }
        } else {
            alertErrorShow('Selecione um arquivo.');
            return false;
        }
    });
});


function enviaArquivo(base64){

	var idempresa = $("#empresa").val();
	$("#btnUploadArquivo").attr("disabled", true).html("Aguarde carregando...");
	$.post(url_sistema + "chave/importaemails", {idempresa: idempresa, base64 : base64}, function(r){

		var retorno = JSON.parse(r);
		var html = "";
		$("#listResultImport").html("");

		html += '<table cellpadding="0" cellspacing="" class="table table-hover table-striped table-bordered">';
		html += '	<thead>';
		html += '	<tr>';
		html += '		<th>';
		html += '			Email';
		html += '		</th>';
		html += '		<th class="text-right">';
		html += '			Status';		
		html += '		</th>';
		html += '	</tr>';
		html += '	<thead>';
		html += '	<tbody>';
		for (var i = 0; i <= retorno.length -1; i++) {
			const element = retorno[i];
			html += '	<tr>';
			html += '		<td>';
			html += element.email;
			html += '		</td>';
			html += '		<td class="text-right ' + element.cor + '" >';
			html +=	element.mensagem;		
			html += '		</td>';
			html += '	</tr>';
		}
		html += '</tbody>';
		html += '</table>';

		$("#listResultImport").html(html);

		$("#btnUploadArquivo").attr("disabled", false).html("Enviar");
	});

}

function alertErrorShow(message) {
    $("#listResultImport").html('<br /><div class="alert alert-danger">' + message + "</div>");
}

function alertSuccessShow(message) {
    $("#listResultImport").html('<br /><div class="alert alert-info">' + message + "</div>");
}

$('#modal-default').on('hidden.bs.modal', function () {
    location.reload(true);
});

function gravaEmail(e){

	if($(e).attr("name") == "btnUploadArquivo"){

		if(confirm("Deseja realmente importar esses e-mails?")){
		
			$("#btnUploadArquivo").attr("disabled", true).html("Aguarde gravando...");
			$.post(url_sistema + "chave/importaemailsgrava", {}, function(r){
				var retorno = JSON.parse(r);

				alert(retorno.mensagem);
				if(retorno.erro != 1){
					location.reload(true);
				}
			});

		}
	}

}