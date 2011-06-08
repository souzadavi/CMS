$(document).ready(function(){
	$('#qtdePPagina').change(function(){
		if(parametro == ''){
			window.location.replace("../" + enderecoPagina + "?pag=1&qtde=" + $(this).val() + "&busca=" + buscaP) ;
		}
		else{
			window.location.replace("../" + enderecoPagina + "?pag=1&qtde=" + $(this).val() + "&busca=" + buscaP + "&par=" + parametro);
		}
	});
	
	/*
	 * Mouse over nos botoes de anterior e proximo - paginação
	 */
	$('#pag_ant').mouseover(function(){
		$(this).css('background','url("../img/botao_paginacao_anterior_over.jpg") no-repeat');
	});
	
	$('#pag_ant').mouseout(function(){
		$(this).css('background','url("../img/botao_paginacao_anterior.jpg") no-repeat');
	});
	
	$('#pag_prox').mouseover(function(){
		$(this).css('background','url("../img/botao_paginacao_proximo_over.jpg") no-repeat');
	});
	
	$('#pag_prox').mouseout(function(){
		$(this).css('background','url("../img/botao_paginacao_proximo.jpg") no-repeat');
	});
	
	$('#sel_todos').change(function(){
		if($(this).attr('checked')){
			$('#campos_tabela input[type=checkbox]').each(function(index,val){
				val.checked = true;
			});
		}
		else{
			$('#campos_tabela input[type=checkbox]').each(function(index,val){
				val.checked = false;
			});
		}
		
	});
	
	
	//apagar itens selecionados
	
	$('#excluir_selecionados').click(function(){
		var vet = new Array();
		
		$('#campos_tabela input[type=checkbox]').each(function(index,val){
			if(val.checked){
				vet.push(val.value);
			}
		});
		if(vet.length > 0){
			$("#msg_alerta").dialog(
					'option', 'buttons', 
					{ 
						"Não": function(){ 
							$(this).dialog("close"); 
						},
						"Sim": function(){
							$.post("../includes/geral-banco-dados.php", { funcao: "deletaDados", vetIds:vet, tabela:tabela,nomeId: nomeId  },
									  function(data){									    
									    if(data == "ok"){
									    	alerta("Apagado com sucesso!");
									    	$("#msg_alerta").dialog(
													'option', 'buttons', 
													{
														"OK": function(){ 
															$(this).dialog("close");
															window.location.reload();
														}
													}
											);
									    }
									  });
							$(this).dialog("close"); 
						}
					}
			);
			alerta('Deseja realmente excluir?');
		}
		else{
			$("#msg_alerta").dialog(
					'option', 'buttons', 
					{ 
						"OK": function(){ 
							$(this).dialog("close"); 
						}
					}
			);
			alerta('Selecione o item para exclusão');
		}
	});
	
	$('#botao_busca').click(function(){
		busca();
	});

	$('#inp_busca').keydown(function(e){
		switch(e.keyCode){
			case 13: 
				busca();
				break;
		}
	});

	$("#exibir_todos").click(function(){
		window.location.replace("../" + enderecoPagina + "?pag=1&qtde=" + $('#qtdePPagina').val() + "&busca=ini");
	});
});

function busca(){
	if(jQuery.trim($('#inp_busca').val()) != '' ){
		window.location.replace("../" + enderecoPagina + "?pag=1&qtde=" + $('#qtdePPagina').val() + "&busca=search&par=" + jQuery.trim($('#inp_busca').val()));
	}
	else{
		$("#msg_alerta").dialog(
				'option', 'buttons',
				{ 
					"OK": function(){ 
						$(this).dialog("close"); 
					}
				}
		);
		alerta("Digite algo para buscar.");
	}
}