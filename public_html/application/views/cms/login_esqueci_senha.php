<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 35,
	'class' => 'input',
);

$enviar = array(
	 'value' => 'Receber nova senha',
	 'name' => 'reset',
	 'class' => 'botao_normal botao',
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'E-mail ou nome de usuário ';
} else {
	$login_label = 'E-mail';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes/includeHeader.php'); ?>
<link rel="stylesheet" type="text/css" href="css/login.css" />
<script type="text/javascript">
$(document).ready(function(){ 
var msg;
<?php if (form_error($login['name'])){ ?>
 	msg = "<?php echo form_error($login['name']); ?>";
	mensagem(msg);
<?php } ?>
});
</script>

<style type="text/css">
.input{
	*margin-left:0;
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
				<span id="texto_login">Para receber uma nova senha, digite seu e-mail cadastrado abaixo.</span>
			</div>
			<div id="form_login">
            <?php echo form_open($this->uri->uri_string()); ?>
			<table width="100%" border="0">
			  <tr>
			    <td><?php echo form_label($login_label, $login['id']); ?></td>
		      <td><div class="estilo_input" id="div_login">
					<?php echo form_input($login); ?></div></td>
			  </tr>
			  <tr>
			    <td height="49">&nbsp;</td>
			    <td>&nbsp;&nbsp;<?php echo form_submit($enviar); ?></td>
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