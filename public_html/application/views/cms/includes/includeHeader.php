<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>Sistema Administrativo</title>
<base href="<?php echo base_url();?><?php echo base_cms();?>" />

<link rel="stylesheet" type="text/css" href="css/base.css" />
<link rel="stylesheet" type="text/css"	href="css/custom-theme/jquery-ui-1.7.2.custom.css" />
<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.Jcrop.min.js"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/District_100.font.js" type="text/javascript"></script>
<script type="text/javascript">
	Cufon.replace('.district',{fontFamily: 'District'});
	Cufon.replace('#txt_administrativo',{fontFamily: 'District'});
	Cufon.replace('#tit_menu_lateral',{fontFamily: 'District'});
	Cufon.replace('#titulo_admin',{fontFamily: 'District'});
	Cufon.replace('.titulo_admin',{fontFamily: 'District'});

	//// INICIO DO SCRIPT DE MENSAGEM 
		function mensagem(msg){
		/*if(msg != ""){
			$('#mensagem').click(function(){
				$(this).hide();
			});
			
			$('#mensagem').delay(800).slideDown(300).delay(15000).slideUp(500);
		}*/
		$('#mensagem').click(function(){
				$(this).hide();
			});
		$("#mensagem").html(msg+'<br>');
		$('#mensagem').delay(800).slideDown(300).delay(8000).slideUp(700);
		}
		$(document).ready(function(){
		<?php echo isset($script_head) ? $script_head : ''; ?>
		});
	//// FIM DO SCRIPT DE MENSAGEM
</script>