$(document).ready(function(){
	//Configura o alerta
	$("#msg_alerta").dialog({
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
			}
		}
	});
        alerta('LEGAL');
});