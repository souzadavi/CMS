$(document).ready(function(){
	
	 $("#msg_alerta").dialog({
			buttons: {
				'Ok': function() {
					$(this).dialog('close');				
				}
			}
	});
	 
	$('#botao_envia').click(function(){
		verificaCampos();
	});
	
	$('#senha').keydown(function(e){
		switch(e.keyCode){
			case 13:				
				verificaCampos();
				break;
		}
	});
});

function verificaCampos(){
	var ver = true;
	var msg = '';
	
	if(jQuery.trim($('#email').val()) == ''){
		ver = false;
		msg += "- Digite o e-mail<br/>";
	}
	
	if(jQuery.trim($('#senha').val()) == ''){
		ver = false;
		msg += "- Digite a senha";
	}
	
	if(!ver){
		alerta(msg);
	}
	else{
		if(!validaMail(jQuery.trim($('#email').val()))){
			msg += "Digite corretamente o e-mail";
			alerta(msg);
		}
		else{
			$('#login').submit();
		}
	}
		
}

function validaMail(mail){
	var padrao =  new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
	return padrao.test(mail);
}