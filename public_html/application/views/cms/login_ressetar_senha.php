<?php
$enviar = array(
	 'value' => 'Trocar senha',
	 'name' => 'change',
	 'class' => 'botao_normal botao',
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'label'   => 'Nova Senha', 
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 35,
	'class' => 'input',
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'label'   => 'Confirmar Nova Senha', 
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 35,
	'class' => 'input',
);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes/includeHeader.php'); ?>
<script type="text/javascript">
$(document).ready(function(){ 
var msg;
<?php if (form_error($confirm_new_password['name'])){ ?>
 	msg = <?php echo form_error($confirm_new_password['name']); ?>;
	mensagem(msg);
<?php } ?>
});
</script>
<link rel="stylesheet" type="text/css" href="css/login.css" />
<style type="text/css">
.input{
	*margin-left:0;
	}
	#form_login{
		width:276px; !important	
	}
	#div_senha estilo_input{
		width:141px; !important	
	}
</style>
</head>

<body>
<div id="mensagem"></div>
<div id="base_login">
	<div id="topo_login">
		<div id="conteudo_logo">
			<img src="img/logo_cliente.png" alt="" />
		</div>
	</div>
	<div id="tit_login"><span id="titulo_login" class="district">Administrativo</span></div>
	<div id="centro_login">
		<div id="miolo_login">
			<div id="div_texto_login">
				<span id="texto_login">Para reenviar receber uma nova senha, digite seu e-mail cadastrado abaixo.</span>
			</div>
			<div id="form_login">
            <?php echo form_open($this->uri->uri_string()); ?>
			<table width="100%" border="0">
			  <tr>
			    <td><?php echo form_label('Nova Senha', $new_password['id']); ?></td>
			    <td><div class="estilo_input" id="div_login"><?php echo form_password($new_password); ?></div></td>
			  </tr>
			  <tr>
                <td height="35"><?php echo form_label('Confirmar Nova Senha', $confirm_new_password['id']); ?></td>
				<td><div class="estilo_input" id="div_login"><?php echo form_password($confirm_new_password); ?></div></td>
			  </tr>
              <tr>
			    <td>&nbsp;</td>
			    <td align="right"><br />			      <?php echo form_submit($enviar); ?></td>
		      </tr>
			</table>
			<?php echo form_close(); ?>
			</div>			
		</div>
	</div>
	<?php include("includes/includeRodape.php"); ?>
</div>
</body>
</html>