
$(document).ready(function (e) {

	$('.group-checkbox input[type="checkbox"]').on('change', function () {

		const tbody = $(this).parent().parent().parent();		
		const checks = tbody.find('input[type="checkbox"]');

		let contador = 0;
		let elemento = null
		checks.each((index, el) => {
			if($(el).is(':checked')) {
				contador++;
				elemento = el;				
			} else {
				$(el).removeAttr('required');
			}
		});

		if(contador <= 0) {
			checks[0].setAttribute('required', true);
			//$(this).attr('required', true);
		} else {
			$(elemento).attr('required', true);
		}
	});

	$('input[type="radio"], input[type="checkbox"]').on('change', function () {

		const name = $(this).attr('name');
		const ref1 = $(`.${name}_especifique`)
		ref1.find('input').attr('required', false);
		ref1.hide();

		const dataTrigger = $(this).attr('data-trigger');
		if(dataTrigger){
			const ref = $(`.${dataTrigger}`);
			if(ref.is(':visible')) {
				ref.find('input').attr('required', false);			
				ref.hide();
			} else {
				ref.find('input').attr('required', true);			
				ref.show();
				ref.find('input').focus();
			}
		}

	});

	let quantidade_selecionado = 0;
	if ($('[name="home_office_aumento"]').length > 0) {

		$('[name="home_office_aumento"], [name="home_office_flexibilidade"], [name="home_office_qualidade"], [name="home_office_possibilidade"], [name="home_office_tempo"]').change(function (e) {
			let check = $(this).is(':checked');
			if (check) {
				quantidade_selecionado++;
				if (quantidade_selecionado > 2) {
					quantidade_selecionado--;
					$(this).attr('checked', !check);
					return false;
				}
			} else {
				quantidade_selecionado--;
			}
		})

	}

	$("#beneficio_convenio_medico").hide();
	$("#beneficio_transporte").hide();
	$("#beneficio_vr").hide();
	$("#beneficio_restaurante").hide();
	$("#beneficio_odontologico").hide();
	$("#seguranca_trabalho").hide();
	$("#tecnologia_informacao").hide();
	$("#outros_lazer").hide();
	$("#outros_maternidade").hide();
	$("#outros_padoca").hide();
	$("#outros_queijos").hide();
	$("#outros_brinquedos").hide();
	$("#outros_material").hide();
	$("#outros_estacionamento, #outros_farmacia, #outros_brinquedos,#outros_material, #outros_jogos, #outros_descanso, #outros_farmacia").hide();
	$(".esconde").hide();

	$('input').attr('autocomplete', 'off');


	$(".sucesso").hide();

	$('input[type="radio"]').click(function (e) {

		if ($(this).val() == 2) {
			$("#dourado_2017_justificativa_" + $(this).attr("data-id")).removeAttr("readonly").attr("required", true).focus();
		} else {
			$("#dourado_2017_justificativa_" + $(this).attr("data-id")).attr("readonly", true).removeAttr("required").val("");
		}


	});

	$("#form").submit(function (event) {
		var ajaxRequest;
		event.preventDefault();
		$(".sucesso").html('Aguarde, estamos processando...').fadeIn(500);;
		$("#botao_cadastrar").hide();

		var values = $(this).serializefiles();
		ajaxRequest = $.ajax({
			url: $(this).attr("action"),
			type: "post",
			cache: false,
			contentType: false,
			processData: false,
			data: values
		});

		ajaxRequest.done(function (response, textStatus, jqXHR) {

			var res = response.split("</strong>");
			var contador = 5;
			$("#contador").html(contador);

			if (res[0] != "<strong>Erro") {
				$('#myModal').modal('show');
				document.location.href = './sucesso';
			}

			$(".sucesso").html(response).fadeIn();;
			$("#botao_cadastrar").fadeIn(500);
		});

		ajaxRequest.fail(function () {
			$(".sucesso").html('Erro ao enviar este formulario.\r\n Entre em contato com o suporte caso o problema persista!').fadeIn();
			$("#botao_cadastrar").fadeIn(500);
		})
	});


	$('#setor').change(function () {
		if ($(this).val()) {
			$('#localidade').hide();
			$.getJSON('xhr/carrega_localidades.ajax.php?search=', { setor: $(this).val(), ajax: 'true' }, function (a) {
				var options = '<option value=""></option>';
				for (var i = 0; i < a.length; i++) {
					options += '<option value="' + a[i].id + '">' + a[i].nome + '</option>';
				}
				$('#localidade').html(options).show();
			});
		} else {
			$('#plano').html('<option value=""></option>').show();
		}
	});


});

function showDiv(div, status) {
	if (status == 1) {
		$("#" + div).show();
		$("#" + div).find("input[type='radio']").attr('required', true);
	} else if (status == 0) {
		$("#" + div).hide();
		$("#" + div).find("input[type='radio']").removeAttr('required').removeAttr('checked');
	}
}

function showDivClass(div, status) {
	if (status == 1) {
		$("." + div).show();
		$("." + div).find("input[type='radio']").attr('required', true);
	} else if (status == 0) {
		$("." + div).hide();
		$("." + div).find("input[type='radio']").removeAttr('required').removeAttr('checked');
	}
}

(function ($) {
	$.fn.serializefiles = function () {
		var obj = $(this);
		var formData = new FormData();
		$.each($(obj).find("input[type='file']"), function (i, tag) {
			$.each($(tag)[0].files, function (i, file) {
				formData.append(tag.name, file);
			});
		});
		var params = $(obj).serializeArray();
		$.each(params, function (i, val) {
			formData.append(val.name, val.value);
		});
		return formData;
	};
})(jQuery);

// document.addEventListener("DOMContentLoaded", function () {
// 	document.getElementById("recarregarPagina").addEventListener("click", function () {
// 		location.reload(); // Isso recarregará a página
// 	});
// });

// document.addEventListener("DOMContentLoaded", function () {
//     var recarregarButton = document.getElementById("recarregarPagina");

//     if (recarregarButton) {  // Verifica se o elemento existe
//         recarregarButton.addEventListener("click", function () {
//             location.reload(); // Isso recarregará a página
//         });
//     } else {
//         console.error("O elemento com o ID 'recarregarPagina' não foi encontrado.");
//     }
// });

document.addEventListener("DOMContentLoaded", function () {
    document.body.addEventListener("click", function (event) {
        if (event.target && event.target.id === "recarregarPagina") {
            // Adiciona um atraso de 3 segundos antes de recarregar a página
            setTimeout(function () {
                location.reload(); // Recarrega a página
            }, 3000); // 3000 milissegundos = 3 segundos
        }
    });
});


// function clicarEmTodosRadios() {
//     // Seleciona todos os inputs do tipo rádio na página
//     const radios = document.querySelectorAll('input[type="radio"]');
    
//     // Itera sobre todos os botões de rádio encontrados
//     radios.forEach(radio => {
//         // Verifica se o rádio ainda não está selecionado
//         if (!radio.checked) {
//             radio.click();
//         }
//     });
// }

// // Chama a função para clicar em todos os rádios
// clicarEmTodosRadios();

